<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\User;
use App\Models\Post;
use App\Models\Admin;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory(5)->create();
        Post::factory(30)->create();
        Admin::create([
            'name'     => 'Administrator',
            'email'    => 'admin1@gmail.com',
            'username' => 'Admin0',
            'role'    => 'admin',
            'password' => bcrypt('password'),
        ]);

        Admin::create([
            'name'     => 'Editor',
            'email'    => 'editor@gmail.com',
            'username' => 'Admin1',
            'role'    => 'editor',
            'password' => bcrypt('password'),
        ]);

        Admin::create([
            'name'     => 'Operator',
            'email'    => 'operator@gmail.com',
            'username' => 'Admin2',
            'role'    => 'operator',
            'password' => bcrypt('password'),
        ]);
        User::create([
            'name' => 'Farras Aldi Alfikri',
            'username' => 'farras30',
            'email' => 'farasaldi30@gmail.com',
            'password' => bcrypt('12345')
        ]);

        // User::create([
        //     'name' => 'Dzikri Septiandi',
        //     'email' => 'dzikri21@gmail.com',
        //     'password' => bcrypt('12345')
        // ]);

        Category::create([
            'name' => 'Web Programing',
            'slug' => 'web-programig'
        ]);

        Category::create([
            'name' => 'Personal',
            'slug' => 'personal'
        ]);

        Category::create([
            'name' => 'Arduino',
            'slug' => 'arduino'
        ]);

        Category::create([
            'name' => 'Web Design',
            'slug' => 'web design'
        ]);


        // Post::create([
        //     'title' => 'Judul Pertama',
        //     'category_id' => 1,
        //     'user_id' => 1,
        //     'slug' => 'judul-pertama',
        //     'excerpt' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eos corporis sint adipisci, dignissimos quod, iure corrupti nisi modi quae laudantium nostrum architecto expedita voluptatem, exercitationem neque. Asperiores debitis a ab vitae quod ratione nobis harum dignissimos tempora ullam culpa placeat, nihil nostrum, illum corrupti possimus blanditiis error laboriosam.',
        //     'body' => '<p> Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eos corporis sint adipisci, dignissimos quod, iure corrupti nisi modi quae laudantium nostrum architecto expedita voluptatem, exercitationem neque. Asperiores debitis a ab vitae quod ratione nobis harum dignissimos tempora ullam culpa placeat, nihil nostrum, illum corrupti possimus blanditiis error laboriosam.</p><p> Molestiae ipsam quis nemo quaerat consequuntur eius, unde beatae doloremque laudantium commodi. Nam cupiditate modi optio nobis, possimus necessitatibus ex reprehenderit, veniam inventore in nisi rem libero sunt ad perspiciatis unde. Nemo eum fugiat aliquam necessitatibus laudantium eius at. Similique libero eveniet laborum officiis optio aliquam eaque, exercitationem deserunt incidunt commodi quidem.</p><p>Unde qui corrupti, magni ullam cum molestias, perspiciatis expedita, consequatur repellat aperiam dolor quisquam accusamus deserunt explicabo exercitationem nobis! Voluptatum asperiores fugiat tempore facilis dolores ipsum animi libero odit cupiditate non, consequatur laboriosam quaerat earum ea, natus enim dolore iusto, exercitationem aspernatur error a. Optio dicta doloribus quo ex ratione minima natus fugiat nesciunt sed molestias nobis cumque quae hic nulla perspiciatis, similique facere aut nostrum? Sint molestias voluptas totam porro dolorum aut quas fuga dolores ipsam nemo. Alias laborum, provident maxime qui numquam est cum aspernatur? Magni, culpa possimus nesciunt laborum quibusdam aspernatur maxime rem quam ab, fugiat quos!</p>'
        // ]);
        // Post::create([
        //     'title' => 'Judul Kedua',
        //     'category_id' => 2,
        //     'user_id' => 2,
        //     'slug' => 'judul-kedua',
        //     'excerpt' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eos corporis sint adipisci, dignissimos quod, iure corrupti nisi modi quae laudantium nostrum architecto expedita voluptatem, exercitationem neque. Asperiores debitis a ab vitae quod ratione nobis harum dignissimos tempora ullam culpa placeat, nihil nostrum, illum corrupti possimus blanditiis error laboriosam.',
        //     'body' => '<p> Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eos corporis sint adipisci, dignissimos quod, iure corrupti nisi modi quae laudantium nostrum architecto expedita voluptatem, exercitationem neque. Asperiores debitis a ab vitae quod ratione nobis harum dignissimos tempora ullam culpa placeat, nihil nostrum, illum corrupti possimus blanditiis error laboriosam.</p><p> Molestiae ipsam quis nemo quaerat consequuntur eius, unde beatae doloremque laudantium commodi. Nam cupiditate modi optio nobis, possimus necessitatibus ex reprehenderit, veniam inventore in nisi rem libero sunt ad perspiciatis unde. Nemo eum fugiat aliquam necessitatibus laudantium eius at. Similique libero eveniet laborum officiis optio aliquam eaque, exercitationem deserunt incidunt commodi quidem.</p><p>Unde qui corrupti, magni ullam cum molestias, perspiciatis expedita, consequatur repellat aperiam dolor quisquam accusamus deserunt explicabo exercitationem nobis! Voluptatum asperiores fugiat tempore facilis dolores ipsum animi libero odit cupiditate non, consequatur laboriosam quaerat earum ea, natus enim dolore iusto, exercitationem aspernatur error a. Optio dicta doloribus quo ex ratione minima natus fugiat nesciunt sed molestias nobis cumque quae hic nulla perspiciatis, similique facere aut nostrum? Sint molestias voluptas totam porro dolorum aut quas fuga dolores ipsam nemo. Alias laborum, provident maxime qui numquam est cum aspernatur? Magni, culpa possimus nesciunt laborum quibusdam aspernatur maxime rem quam ab, fugiat quos!</p>'
        // ]);
    }
}
