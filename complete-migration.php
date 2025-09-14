Here are the complete migration corresponding schema files in the correct order to maintain foreign key relationships:

Schema::create('users', function (Blueprint $table) {
$table->id();
$table->string('name');
$table->string('email')->unique();
$table->string('phone')->nullable();
$table->string('password');
$table->enum('role', ['seller', 'buyer', 'admin'])->default('buyer');
$table->string('profile_image')->nullable();
$table->string('address')->nullable();
$table->string('city')->nullable();
$table->string('country')->nullable();
$table->boolean('is_verified')->default(false);
$table->timestamp('email_verified_at')->nullable();
$table->rememberToken();
$table->timestamps();
$table->softDeletes();
});

Schema::create('seller_profiles', function (Blueprint $table) {
$table->id();
$table->foreignId('creater_id')->nullable();// Assuming this is the user who created the profile
$table->foreignId('user_id')->constrained()->onDelete('cascade');
$table->string('farm_name')->nullable();
$table->text('bio')->nullable();
$table->string('document_type')->nullable();
$table->string('document_number')->nullable();
$table->string('document_image')->nullable();
$table->boolean('is_approved')->default(false);
$table->timestamps();
});

Schema::create('buyer_profiles', function (Blueprint $table) {
$table->id();
$table->foreignId('creater_id')->nullable();// Assuming this is the user who created the profile
$table->foreignId('user_id')->constrained()->onDelete('cascade');
$table->string('preferred_animal_type')->nullable();
$table->text('shipping_address')->nullable();
$table->timestamps();
});

Schema::create('animal_categories', function (Blueprint $table) {
$table->id();
$table->string('name');
$table->string('slug')->unique();
$table->text('description')->nullable();
$table->string('image')->nullable();
$table->timestamps();
});

Schema::create('animals', function (Blueprint $table) {
$table->id();
$table->foreignId('seller_id')->constrained('users')->onDelete('cascade');
$table->foreignId('category_id')->constrained('animal_categories');
$table->string('name');
$table->integer('age');
$table->date('date_of_birth')->nullable();
$table->string('color');
$table->decimal('weight', 8, 2);
$table->decimal('height', 8, 2)->nullable();
$table->enum('gender', ['male', 'female', 'other']);
$table->text('health_info')->nullable();
$table->text('feed_details')->nullable();
$table->string('location');
$table->decimal('price', 10, 2);
$table->enum('sale_type', ['fixed', 'auction', 'group']);
$table->enum('status', ['available', 'sold', 'not_for_sale', 'expired'])->default('available');
$table->boolean('is_featured')->default(false);
$table->timestamps();
$table->softDeletes();
});

Schema::create('animal_images', function (Blueprint $table) {
$table->id();
$table->foreignId('animal_id')->constrained()->onDelete('cascade');
$table->string('image_path');
$table->boolean('is_primary')->default(false);
$table->timestamps();
});

Schema::create('group_sales', function (Blueprint $table) {
$table->id();
$table->foreignId('seller_id')->constrained('users')->onDelete('cascade');
$table->string('group_name');
$table->text('description')->nullable();
$table->decimal('total_price', 10, 2);
$table->integer('animal_count');
$table->timestamps();
});

Schema::create('group_sale_animals', function (Blueprint $table) {
$table->id();
$table->foreignId('group_sale_id')->constrained()->onDelete('cascade');
$table->foreignId('animal_id')->constrained()->onDelete('cascade');
$table->timestamps();
});

Schema::create('auctions', function (Blueprint $table) {
$table->id();
$table->foreignId('animal_id')->constrained()->onDelete('cascade');
$table->decimal('starting_price', 10, 2);
$table->decimal('current_bid', 10, 2)->nullable();
$table->dateTime('start_time');
$table->dateTime('end_time');
$table->enum('status', ['pending', 'active', 'closed'])->default('pending');
$table->timestamps();
});

Schema::create('bids', function (Blueprint $table) {
$table->id();
$table->foreignId('auction_id')->constrained()->onDelete('cascade');
$table->foreignId('user_id')->constrained()->onDelete('cascade');
$table->decimal('amount', 10, 2);
$table->timestamps();
});

Schema::create('orders', function (Blueprint $table) {
$table->id();
$table->foreignId('buyer_id')->constrained('users')->onDelete('cascade');
$table->foreignId('seller_id')->constrained('users')->onDelete('cascade');
$table->decimal('total_amount', 10, 2);
$table->enum('payment_method', ['cod', 'bank_transfer', 'jazzcash', 'easypaisa']);
$table->enum('payment_status', ['pending', 'paid', 'failed'])->default('pending');
$table->enum('shipping_payer', ['buyer', 'seller']);
$table->text('shipping_address');
$table->enum('status', ['pending', 'shipped', 'delivered', 'cancelled', 'returned'])->default('pending');
$table->timestamps();
});

Schema::create('order_items', function (Blueprint $table) {
$table->id();
$table->foreignId('order_id')->constrained()->onDelete('cascade');
$table->foreignId('animal_id')->constrained()->onDelete('cascade');
$table->decimal('price', 10, 2);
$table->integer('quantity')->default(1);
$table->timestamps();
});

Schema::create('chats', function (Blueprint $table) {
$table->id();
$table->foreignId('seller_id')->constrained('users')->onDelete('cascade');
$table->foreignId('buyer_id')->constrained('users')->onDelete('cascade');
$table->timestamps();
});

Schema::create('messages', function (Blueprint $table) {
$table->id();
$table->foreignId('chat_id')->constrained()->onDelete('cascade');
$table->foreignId('sender_id')->constrained('users')->onDelete('cascade');
$table->text('message');
$table->boolean('is_read')->default(false);
$table->timestamps();
});

Schema::create('reviews', function (Blueprint $table) {
$table->id();
$table->foreignId('reviewer_id')->constrained('users')->onDelete('cascade');
$table->foreignId('seller_id')->constrained('users')->onDelete('cascade');
$table->foreignId('order_id')->nullable()->constrained()->onDelete('set null');
$table->integer('rating');
$table->text('comment')->nullable();
$table->timestamps();
});

Schema::create('admin_actions', function (Blueprint $table) {
$table->id();
$table->foreignId('admin_id')->constrained('users')->onDelete('cascade');
$table->string('action');
$table->text('details')->nullable();
$table->timestamps();
});

Schema::create('reports', function (Blueprint $table) {
$table->id();
$table->foreignId('reporter_id')->constrained('users')->onDelete('cascade');
$table->foreignId('reported_user_id')->constrained('users')->onDelete('cascade');
$table->foreignId('animal_id')->nullable()->constrained()->onDelete('set null');
$table->text('reason');
$table->enum('status', ['pending', 'resolved', 'rejected'])->default('pending');
$table->timestamps();
});

Schema::table('animal_categories', function (Blueprint $table) {
$table->unsignedBigInteger('parent_id')->nullable()->after('image');
$table->integer('depth')->default(0)->after('parent_id');
$table->foreign('parent_id')->references('id')->on('animal_categories')->onDelete('cascade');
});