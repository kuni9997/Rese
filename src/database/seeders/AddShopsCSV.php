<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Goodby\CSV\Import\Standard\Lexer;
use Goodby\CSV\Import\Standard\Interpreter;
use Goodby\CSV\Import\Standard\LexerConfig;

class AddShopsCSV extends Seeder
{
    const CSV_FILENAME = '/../database/seeders/Shops.csv';
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->command->info('[Start] import data.');

        $config = new LexerConfig();

        $config->setDelimiter(",");
        $config->setIgnoreHeaderLine(true);
        $lexer = new Lexer($config);
        $interpreter = new Interpreter();
        $interpreter->addObserver(function (array $row) {

            $shop = \App\Models\Shop::create([
                'shop_name' => $row[0],
                'area' => $row[1],
                'genre' => $row[2],
                'shop_desc' => $row[3],
                'pic_url' => $row[4],
                'registered_id' => $row[5]
            ]);
        });

        $lexer->parse(app_path() . self::CSV_FILENAME, $interpreter);

        $this->command->info('[End] import data.');
    }
}