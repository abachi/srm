<?php

namespace Tests\Feature;

use App\Domain\ResourceTypes;
use App\Exceptions\ResourceIsNoSupportedException;
use App\Models\Resource\CodeSnippet;
use App\Models\Resource\File;
use App\Models\Resource\Link;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ResourceApiTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function should_create_a_resource()
    {
        $this->assertEquals(0, Link::count());

        $data = [
            'resource_type' => ResourceTypes::LINK_TYPE,
            'title' => 'A cool company',
            'link' => 'https://remotecompany.com',
            'open_new_tab' => false,
        ];

        $this->post(route('resources.store'), $data)
            ->assertStatus(Response::HTTP_CREATED)
            ->assertJsonFragment([
                'id' => 1,
                'title' => $data['title'],
                'link' => $data['link'],
                'open_new_tab' => $data['open_new_tab'],
            ]);

        $this->assertEquals(1, Link::count());
    }

    /** @test */
    public function should_update_a_resource()
    {
        $resource = Link::factory()->create([
            'title' => 'A bad company',
            'link' => 'https://foo.com',
            'open_new_tab' => false,
        ]);

        $newData = [
            'title' => 'A cool company',
            'link' => 'https://bar.com',
            'open_new_tab' => true,
        ];

        $params = [
            'resource_type' => ResourceTypes::LINK_TYPE,
            'id' => $resource->id,
        ];

        $this->post(route('resources.update', $params), $newData)
            ->assertStatus(Response::HTTP_OK)
            ->assertJsonFragment($newData);

        $resource->refresh();

        $this->assertEquals($resource->title, $newData['title']);
        $this->assertEquals($resource->link, $newData['link']);
        $this->assertEquals($resource->open_new_tab, $newData['open_new_tab']);
    }
    /** @test */
    public function should_throw_an_exception_if_resource_type_is_not_provided()
    {
        $this->withoutExceptionHandling();

        $this->expectException(ResourceIsNoSupportedException::class);

        $this->post(route('resources.store'));
    }

    /** @test */
    public function should_throw_an_exception_if_resource_type_is_not_supported()
    {
        $this->withoutExceptionHandling();

        $this->expectException(ResourceIsNoSupportedException::class);

        $data = [
            'resource_type' => 'NOT_SUPPORTED_TYPE_123',
        ];

        $this->post(route('resources.store'), $data);
    }

    /** @test */
    public function should_return_a_resource()
    {
        $codeSnippet = CodeSnippet::factory()->create();

        $params = ['id' => $codeSnippet->id, 'resource_type' => ResourceTypes::HTML_SNIPPET_TYPE];

        $this->get(route('resources.show', $params))
            ->assertStatus(Response::HTTP_OK)
            ->assertJsonFragment([
                'id' => $codeSnippet->id,
                'title' => $codeSnippet->title,
                'description' => $codeSnippet->description,
                'code_snippet' => $codeSnippet->code_snippet,
            ]);
    }

    /** @test */
    public function should_return_not_found_for_non_existing_resource()
    {
        $params = ['id' => 999, 'resource_type' => ResourceTypes::PDF_FILE_TYPE];

        $this->get(route('resources.show', $params))
            ->assertStatus(Response::HTTP_NOT_FOUND);
    }

    /** @test */
    public function should_delete_a_resource()
    {
        Storage::fake('local');

        $this->assertEquals(0, count(Storage::disk('local')->allDirectories()));

        $pdfFile = File::factory()->create(['type' => 'pdf']);
        $params = ['id' => $pdfFile->id, 'resource_type' => ResourceTypes::PDF_FILE_TYPE];

        $this->assertTrue(Storage::disk('local')->exists($pdfFile->path));

        $this->post(route('resources.delete', $params))->assertStatus(Response::HTTP_NO_CONTENT);

        $this->assertFalse(Storage::disk('local')->exists($pdfFile->path));
        $this->assertNull(File::where('id', $pdfFile->id)->get()->first());
    }

}
