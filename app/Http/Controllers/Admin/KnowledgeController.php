<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Domains\AIKnowledge\Models\AIDocument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class KnowledgeController extends Controller
{
    public function index()
    {
        $documents = AIDocument::latest()->get();
        return view('admin.knowledge.index', compact('documents'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|in:manual,brochure,datasheet',
            'file' => 'required|file|mimes:pdf,doc,docx|max:10240',
        ]);

        $path = $request->file('file')->store('ai_knowledge');

        AIDocument::create([
            'title' => $request->title,
            'type' => $request->type,
            'file_path' => $path,
            'is_indexed' => false,
        ]);

        return back()->with('success', 'Document uploaded and queued for technical indexing.');
    }

    public function indexDocument(AIDocument $document)
    {
        // Mocking the indexing process (OCR/Parsing)
        $document->update([
            'is_indexed' => true,
            'content_extracted' => "Extracted technical data from {$document->title}..."
        ]);

        return back()->with('success', 'Document successfully indexed into the AI Knowledge Base.');
    }
}
