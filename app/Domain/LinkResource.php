<?php

namespace App\Domain;

use App\Models\Resource\Link;

class LinkResource implements ResourcesInterface
{

    public function __construct()
    {
    }

    function rules(): array
    {
        return [
            'title' => 'required',
            'link' => 'required|url',
            'open_new_tab' => 'boolean',
        ];
    }

    public function store(array $data): Link
    {
        return Link::create([
            'title' => $data['title'],
            'link' => $data['link'],
            'open_new_tab' => $data['open_new_tab'],
        ]);
    }

    public function get(string $id): Link
    {
        return Link::findOrfail($id);
    }

    public function update($id, array $data): Link
    {
        $link = Link::findOrfail($id);
        $link->update([
           'title' => $data['title'],
           'link' => $data['link'],
           'open_new_tab' => $data['open_new_tab'],
        ]);
        return $link;
    }

    public function delete($id): void
    {
        Link::findOrfail($id)->delete();
    }
}