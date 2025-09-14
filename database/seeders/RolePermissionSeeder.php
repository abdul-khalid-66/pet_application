<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create permissions
        $permissions = [
            'user.create',
            'user.read',
            'user.update',
            'user.delete',
            'seller.create',
            'seller.read',
            'seller.update',
            'seller.delete',
            'buyer.create',
            'buyer.read',
            'buyer.update',
            'buyer.delete',
            'animal.create',
            'animal.read',
            'animal.update',
            'animal.delete',
            'category.create',
            'category.read',
            'category.update',
            'category.delete',
            'order.create',
            'order.read',
            'order.update',
            'order.delete',
            'auction.create',
            'auction.read',
            'auction.update',
            'auction.delete',
            'bid.create',
            'bid.read',
            'bid.update',
            'bid.delete',
            'report.create',
            'report.read',
            'report.update',
            'report.delete',
            'dashboard.access',
            'settings.manage'
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // Create roles and assign permissions
        $superAdmin = Role::create(['name' => 'superadmin']);
        $superAdmin->givePermissionTo(Permission::all());

        $admin = Role::create(['name' => 'admin']);
        $admin->givePermissionTo([
            'user.create',
            'user.read',
            'user.update',
            'seller.create',
            'seller.read',
            'seller.update',
            'buyer.create',
            'buyer.read',
            'buyer.update',
            'animal.read',
            'animal.update',
            'animal.delete',
            'category.create',
            'category.read',
            'category.update',
            'order.read',
            'order.update',
            'auction.read',
            'auction.update',
            'bid.read',
            'report.read',
            'report.update',
            'dashboard.access',
            'settings.manage'
        ]);

        $seller = Role::create(['name' => 'seller']);
        $seller->givePermissionTo([
            'animal.create',
            'animal.read',
            'animal.update',
            'animal.delete',
            'order.read',
            'auction.create',
            'auction.read',
            'auction.update',
            'bid.read',
            'dashboard.access'
        ]);

        $buyer = Role::create(['name' => 'buyer']);
        $buyer->givePermissionTo([
            'animal.read',
            'order.create',
            'order.read',
            'auction.read',
            'bid.create',
            'bid.read',
            'bid.update',
            'dashboard.access'
        ]);
    }
}
