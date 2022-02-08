<?php

namespace App\Http\Repositories\Scraper;

use App\Http\Repositories\BaseRepository;
use App\Http\Repositories\RepositoryInterface;
use App\Models\Scraper;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ScraperRepository
 *
 * @package App\Http\Repositories\ScraperRepository
 * @author Mahammad Mammadov <muhammed.mammadov.89@gmail.com>
 */
class ScraperRepository extends BaseRepository
{
    /**
     * ScraperRepository constructor.
     *
     * @param Scraper $model
     */
    public function __construct(Scraper $model)
    {
        parent::__construct($model);
    }

}
