<?php
namespace Untrefmedia\UMBooks\Database\Seed;

use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        \DB::table('permissions')->delete();

        \DB::table('permissions')->insert(array(
            0  => array(
                'id'         => 1,
                'name'       => 'venue-list',
                'guard_name' => 'admin',
                'created_at' => '2019-02-08 17:34:58',
                'updated_at' => '2019-02-08 17:34:58'
            ),
            1  => array(
                'id'         => 2,
                'name'       => 'venue-create',
                'guard_name' => 'admin',
                'created_at' => '2019-02-08 17:34:58',
                'updated_at' => '2019-02-08 17:34:58'
            ),
            2  => array(
                'id'         => 3,
                'name'       => 'venue-edit',
                'guard_name' => 'admin',
                'created_at' => '2019-02-08 17:34:58',
                'updated_at' => '2019-02-08 17:34:58'
            ),
            3  => array(
                'id'         => 4,
                'name'       => 'venue-delete',
                'guard_name' => 'admin',
                'created_at' => '2019-02-08 17:34:58',
                'updated_at' => '2019-02-08 17:34:58'
            ),
            4  => array(
                'id'         => 5,
                'name'       => 'book-list',
                'guard_name' => 'admin',
                'created_at' => '2019-02-08 17:38:30',
                'updated_at' => '2019-02-08 17:38:30'
            ),
            5  => array(
                'id'         => 6,
                'name'       => 'book-create',
                'guard_name' => 'admin',
                'created_at' => '2019-02-08 17:38:30',
                'updated_at' => '2019-02-08 17:38:30'
            ),
            6  => array(
                'id'         => 7,
                'name'       => 'book-edit',
                'guard_name' => 'admin',
                'created_at' => '2019-02-08 17:38:30',
                'updated_at' => '2019-02-08 17:38:30'
            ),
            7  => array(
                'id'         => 8,
                'name'       => 'book-delete',
                'guard_name' => 'admin',
                'created_at' => '2019-02-08 17:38:31',
                'updated_at' => '2019-02-08 17:38:31'
            ),
            8  => array(
                'id'         => 9,
                'name'       => 'event-list',
                'guard_name' => 'admin',
                'created_at' => '2019-02-08 17:38:46',
                'updated_at' => '2019-02-08 17:38:46'
            ),
            9  => array(
                'id'         => 10,
                'name'       => 'event-create',
                'guard_name' => 'admin',
                'created_at' => '2019-02-08 17:38:47',
                'updated_at' => '2019-02-08 17:38:47'
            ),
            10 => array(
                'id'         => 11,
                'name'       => 'event-edit',
                'guard_name' => 'admin',
                'created_at' => '2019-02-08 17:38:47',
                'updated_at' => '2019-02-08 17:38:47'
            ),
            11 => array(
                'id'         => 12,
                'name'       => 'event-delete',
                'guard_name' => 'admin',
                'created_at' => '2019-02-08 17:38:47',
                'updated_at' => '2019-02-08 17:38:47'
            ),
            12 => array(
                'id'         => 13,
                'name'       => 'eventBlocked-list',
                'guard_name' => 'admin',
                'created_at' => '2019-02-08 17:38:58',
                'updated_at' => '2019-02-08 17:38:58'
            ),
            13 => array(
                'id'         => 14,
                'name'       => 'eventBlocked-create',
                'guard_name' => 'admin',
                'created_at' => '2019-02-08 17:38:58',
                'updated_at' => '2019-02-08 17:38:58'
            ),
            14 => array(
                'id'         => 15,
                'name'       => 'eventBlocked-edit',
                'guard_name' => 'admin',
                'created_at' => '2019-02-08 17:38:58',
                'updated_at' => '2019-02-08 17:38:58'
            ),
            15 => array(
                'id'         => 16,
                'name'       => 'eventBlocked-delete',
                'guard_name' => 'admin',
                'created_at' => '2019-02-08 17:38:58',
                'updated_at' => '2019-02-08 17:38:58'
            )
        ));

    }
}
