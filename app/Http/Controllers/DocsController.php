<?php

namespace App\Http\Controllers;

use App\Documentation;
use Symfony\Component\DomCrawler\Crawler;

class DocsController extends Controller
{
    /**
     * The Documentation instance.
     *
     * @var \App\Documentation
     */
    protected $docs;

    /**
     * Create a new controller instance.
     *
     * @param  \App\Documentation  $docs
     * @return void
     */
    public function __construct(Documentation $docs)
    {
        $this->docs = $docs;
    }

    /**
     * Show the documentation page.
     *
     * @param  string  $page
     * @return \Illuminate\Http\Response
     */
    public function show($page = 'installation')
    {
        $content = $this->docs->get($page);

        if (is_null($content)) {
            abort(404);
        }

        $title = (new Crawler($content))->filterXPath('//h1');

        return view('docs', [
            'title' => count($title) ? $title->text() : null,
            'content' => $content,
            'index' => $this->docs->get('documentation'),
        ]);
    }
}
