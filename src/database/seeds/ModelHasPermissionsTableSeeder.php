<?php
namespace Untrefmedia\UMBooks\Database\Seed;

use Illuminate\Database\Seeder;

class ModelHasPermissionsTableSeeder extends Seeder
{
    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        \DB::table('model_has_permissions')->delete();

        \DB::table('model_has_permissions')->insert(array(
            0  => array(
                'permission_id' => 1,
                'model_type'    => 'App\\Admin',
                'model_id'      => 1
            ),
            1  => array(
                'permission_id' => 2,
                'model_type'    => 'App\\Admin',
                'model_id'      => 1
            ),
            2  => array(
                'permission_id' => 3,
                'model_type'    => 'App\\Admin',
                'model_id'      => 1
            ),
            3  => array(
                'permission_id' => 4,
                'model_type'    => 'App\\Admin',
                'model_id'      => 1
            ),
            4  => array(
                'permission_id' => 5,
                'model_type'    => 'App\\Admin',
                'model_id'      => 1
            ),
            5  => array(
                'permission_id' => 6,
                'model_type'    => 'App\\Admin',
                'model_id'      => 1
            ),
            6  => array(
                'permission_id' => 7,
                'model_type'    => 'App\\Admin',
                'model_id'      => 1
            ),
            7  => array(
                'permission_id' => 8,
                'model_type'    => 'App\\Admin',
                'model_id'      => 1
            ),
            8  => array(
                'permission_id' => 9,
                'model_type'    => 'App\\Admin',
                'model_id'      => 1
            ),
            9  => array(
                'permission_id' => 10,
                'model_type'    => 'App\\Admin',
                'model_id'      => 1
            ),
            10 => array(
                'permission_id' => 11,
                'model_type'    => 'App\\Admin',
                'model_id'      => 1
            ),
            11 => array(
                'permission_id' => 12,
                'model_type'    => 'App\\Admin',
                'model_id'      => 1
            ),
            12 => array(
                'permission_id' => 13,
                'model_type'    => 'App\\Admin',
                'model_id'      => 1
            ),
            13 => array(
                'permission_id' => 14,
                'model_type'    => 'App\\Admin',
                'model_id'      => 1
            ),
            14 => array(
                'permission_id' => 15,
                'model_type'    => 'App\\Admin',
                'model_id'      => 1
            ),
            15 => array(
                'permission_id' => 16,
                'model_type'    => 'App\\Admin',
                'model_id'      => 1
            )
        ));

    }
}
