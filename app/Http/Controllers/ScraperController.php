<?php

namespace App\Http\Controllers;

use Exception;
use Goutte\Client;
use App\Http\Repositories\Scraper\ScraperRepository;
use App\Http\Services\ScraperService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * class ScraperController
 *
 * @package App\Http\Controllers
 * @author Mahmmad mammadov <muhammed.mammadov@gmail.com>
 */
class ScraperController extends Controller
{
    /**
     * @var ScraperService
     */
    protected $scraperService;

    /**
     * @var ScraperRepository
     */
    protected $scraperRepository;

    /**
     * ScraperController constructor.
     *
     * @param ScraperService $scraperService
     * @param ScraperRepository $scraperRepository
     */
    public function __construct(
        ScraperService $scraperService,
        ScraperRepository $scraperRepository
    )
    {
        $this->scraperService = $scraperService;
        $this->scraperRepository = $scraperRepository;
    }

    /**
     * Get scraped data
     *
     * @param Client $client
     * @return void
     */
    public function all(Client $client) {
       $data = $this->scraperRepository->all();

       return view('welcome',["data"=>$data]);
    }

    /**
     * @param Client $client
     * @return string
     */
    public function store(Client $client): string
    {
        try {
            $this->scraperRepository->insert($this->scraperService->parseScraper($client));
        } catch(Exception $exception) {
            return  response()->json([
                'message' => $exception->getMessage(),
                'status' => Response::HTTP_SERVICE_UNAVAILABLE,
            ]);
        }
        return  response()->json([
            'message' => 'All scraper data added successfully',
            'status' => Response::HTTP_ACCEPTED,
        ]);
    }

    public function update(int $id, Request $request): JsonResponse
    {
        try {
            $this->scraperRepository->update($id, $request->all());
        } catch (ModelNotFoundException $e) {
            return  response()->json([
                'message' => 'Record not found',
                'alert' => 'alert-danger',
                'status' => Response::HTTP_NOT_FOUND,
            ]);
        } catch (Exception $e) {
            return  response()->json([
                'message' => $e->getMessage(),
                'alert' => 'alert-danger',
                'status' => Response::HTTP_SERVICE_UNAVAILABLE,
            ]);
        }

        return  response()->json([
            'message' => 'Point value updated successfully',
            'alert' => 'alert-success',
            'status' => Response::HTTP_ACCEPTED,
        ]);
    }
}
