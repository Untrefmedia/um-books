<?php
namespace Untrefmedia\UMBooks\Database\Seed;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        Permission::create(['guard_name' => 'admin', 'name' => 'venue-list']);
        Permission::create(['guard_name' => 'admin', 'name' => 'venue-create']);
        Permission::create(['guard_name' => 'admin', 'name' => 'venue-edit']);
        Permission::create(['guard_name' => 'admin', 'name' => 'venue-delete']);

        Permission::create(['guard_name' => 'admin', 'name' => 'book-list']);
        Permission::create(['guard_name' => 'admin', 'name' => 'book-create']);
        Permission::create(['guard_name' => 'admin', 'name' => 'book-edit']);
        Permission::create(['guard_name' => 'admin', 'name' => 'book-delete']);

        Permission::create(['guard_name' => 'admin', 'name' => 'event-list']);
        Permission::create(['guard_name' => 'admin', 'name' => 'event-create']);
        Permission::create(['guard_name' => 'admin', 'name' => 'event-edit']);
        Permission::create(['guard_name' => 'admin', 'name' => 'event-delete']);

        Permission::create(['guard_name' => 'admin', 'name' => 'eventBlocked-list']);
        Permission::create(['guard_name' => 'admin', 'name' => 'eventBlocked-create']);
        Permission::create(['guard_name' => 'admin', 'name' => 'eventBlocked-edit']);
        Permission::create(['guard_name' => 'admin', 'name' => 'eventBlocked-delete']);
    }
}
