<?php

namespace App\Http\Controllers;

use App\Distributors\AllDistributors;
use App\Distributors\Search;
use App\Http\Requests\SearchRequest;
use App\Repository\XmlFileRepository;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;

class SearchController extends Controller
{

    public function allDistributorsSortedArray($systemType)
    {
        if(!in_array($systemType, ['kodeks','techexpert'])){
            abort(404);
        }
        $xml = app(XmlFileRepository::class)->getXmlFileBySystemType($systemType);
        // $validated = $request->validate($systemType);

        $app = app(AllDistributors::class)->array($xml);
        return $app->arrayWithRegionsCenters();
    }

    public function searchByCity(SearchRequest $request, $systemType)
    {
        $searchValue= $request->query('search');
        $array = $this->allDistributorsSortedArray($systemType);
        return app(Search::class)->getEmailsbyCity($searchValue, $array);
    }
}
