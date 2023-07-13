<?php

namespace Database\Factories;

use Libs\Utilities;
use App\Models\Manual;
use Faker\Factory as FakerFactory;

class ManualFactory
{
    protected $model;
    protected $faker;
    protected $utilities;

    public function __construct()
    {
        $this->model     = new Manual();
        $this->faker     = FakerFactory::create($_ENV['DB_FAKER_LOCALE']);
        $this->utilities = new Utilities();
    }

    public function executeFactory($totalRows = 11)
    {
        // Eliminar todas las filas de la tabla antes de volver a insertar registros ficticios
        $this->model->deleteAll();

        foreach (range(1, $totalRows) as $row) {
            $randomDate = $this->faker->dateTimeBetween($startDate = '-5 years', $endDate = 'now');

            $title       = explode('.', $this->faker->unique()->sentence())[0];
            $excerpt     = $this->faker->text();
            ////$description = '<p>' . implode('</p><p>', $this->faker->paragraphs(mt_rand(1, 4))) . '</p>';
            $description = $this->utilities->formatFromTextAreaToBD($this->faker->paragraphs(mt_rand(1, 4)));
            // $order       = mt_rand(1, $totalRows);
            $order       = $this->faker->numberBetween(1, $totalRows);
            $created_at  = $randomDate;
            $updated_at  = $randomDate;

            $data = [
                'title'       => $title,
                'excerpt'     => $excerpt,
                'description' => $description,
                'order'       => $order,
                'created_at'  => $created_at,
                'updated_at'  => $updated_at,
            ];

            // Hacer un INSERT en la tabla por cada ciclo pasando los datos ficticios
            $this->model->insert($data);
        }
    }
}
