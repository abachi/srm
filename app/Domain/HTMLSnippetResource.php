<?php

namespace App\Domain;

use App\Models\Resource\CodeSnippet;

class HTMLSnippetResource implements ResourcesInterface
{
    public function rules(): array
    {
        return [
            'title' => 'required',
            'code_snippet' => 'required',
            'description' => 'required',
        ];
    }

    public function store(array $data): CodeSnippet
    {
        return CodeSnippet::create([
            'title' => $data['title'],
            'description' => $data['description'],
            'code_snippet' => $data['code_snippet'],
            'type' => 'html',
        ]);
    }

    public function update(string $id, array $data): CodeSnippet
    {
        $codeSnippet = CodeSnippet::findOrFail($id);
        $codeSnippet->update($data);
        return $codeSnippet;
    }

    public function get(string $id): CodeSnippet
    {
        $codeSnippet = CodeSnippet::findOrFail($id);
        return $codeSnippet;
    }

    public function delete(string $id): void
    {
        $codeSnippet = CodeSnippet::findOrFail($id);
        $codeSnippet->delete();
    }
}