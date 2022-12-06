<?php

use App\Model\Document;
use App\Model\History;
use Illuminate\Database\Seeder;

class reset_document_dan_history extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Document::truncate();
        History::truncate();
    }
}
