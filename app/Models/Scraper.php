<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Scraper
 *
 * @package App\Models
 * @author Mahammad Mammadov <muhammed.mammadov.89@gmail.com>
 */
class Scraper extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table ='scrapers';

    /**
     * @var string[]
     */
    protected $fillable = ['title', 'link', 'point', 'created'];
}
