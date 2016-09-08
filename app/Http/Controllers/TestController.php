<?php
namespace App\Http\Controllers;
use App\Models\Modules\Client;
use App\TestFilters;
use Illuminate\Database\Eloquent\Collection;
class TestController extends Controller
{
    /**
     * Show all lessons.
     *
     * @param  LessonFilters $filters
     * @return Collection
     */
    public function index(TestFilters $filters)
    {
        return Client::filter($filters)->get();
    }
}