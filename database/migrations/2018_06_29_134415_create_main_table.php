    <?php

    use Illuminate\Support\Facades\Schema;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Database\Migrations\Migration;

    class CreateMainTable extends Migration
    {
        /**
         * Run the migrations.
         *
         * @return void
         */
        public function up()
        {

            Schema::create('brands', function (Blueprint $table) {
                $table->increments('id');
                $table->string('name');
                $table->string('image')->nullable();
                $table->text('description')->nullable();
                $table->timestamps();
                $table->engine = 'InnoDB';
            });

            Schema::create('colors', function (Blueprint $table) {
                $table->increments('id');
                $table->string('name');
                $table->text('description')->nullable();
                $table->timestamps();
                $table->engine = 'InnoDB';
            });

            Schema::create('carriers', function (Blueprint $table) {
                $table->increments('id');
                $table->string('name');
                $table->text('description')->nullable();
                $table->timestamps();
                $table->engine = 'InnoDB';
            });

            Schema::create('sizes', function (Blueprint $table) {
                $table->increments('id');
                $table->double('value', 19, 2)->default(0);
                $table->enum('unit', ["KB","MB","GB","TB"])->nullable();
                $table->timestamps();
                $table->engine = 'InnoDB';
            });

            Schema::create('conditions', function (Blueprint $table) {
                $table->increments('id');
                $table->string('name');
                $table->double('price', 19, 2)->default(0);
                $table->string('link');
                $table->timestamps();
                $table->engine = 'InnoDB';
            });

            Schema::create('gadgets', function (Blueprint $table) {
                $table->increments('id');
                $table->string('gadget_id')->nullable();
                $table->string('name');
                $table->string('image')->nullable();
                $table->text('description')->nullable();
                $table->unsignedInteger('brand_id')->nullable();
                $table->timestamps();
                $table->engine = 'InnoDB';
                $table->foreign('brand_id')->references('id')->on('brands')->onDelete('cascade');
            });

            Schema::create('models', function (Blueprint $table) {
                $table->increments('id');
                $table->string('name');
                $table->string('image')->nullable();
                $table->text('description')->nullable();
                $table->unsignedInteger('gadget_id')->nullable();
                $table->timestamps();
                $table->engine = 'InnoDB';
                $table->foreign('gadget_id')->references('id')->on('gadgets')->onDelete('cascade');
            });

            Schema::create('devices', function (Blueprint $table) {
                $table->increments('id');
                $table->string('device_id')->nullable();
                $table->string('name');
                $table->string('image')->nullable();
                $table->text('description')->nullable();
                $table->unsignedInteger('model_id')->nullable();
                $table->unsignedInteger('color_id')->nullable();
                $table->unsignedInteger('size_id')->nullable();
                $table->unsignedInteger('carrier_id')->nullable();
                $table->double('price', 19, 2)->default(0);
                $table->timestamps();
                $table->engine = 'InnoDB';
                $table->foreign('model_id')->references('id')->on('models')->onDelete('cascade');
                $table->foreign('color_id')->references('id')->on('colors')->onDelete('cascade');
                $table->foreign('size_id')->references('id')->on('sizes')->onDelete('cascade');
                $table->foreign('carrier_id')->references('id')->on('carriers')->onDelete('cascade');
            });

            Schema::create('device_condition', function (Blueprint $table) {
             $table->unsignedInteger('device_id');
             $table->unsignedInteger('condition_id');
             $table->foreign('device_id')->references('id')->on('devices')->onDelete('cascade');
             $table->foreign('condition_id')->references('id')->on('conditions')->onDelete('cascade');
             $table->engine = 'InnoDB';  
             $table->primary(['device_id', 'condition_id']);
         });

            Schema::create('parts', function (Blueprint $table) {
                $table->increments('id');
                $table->string('name');
                $table->string('image')->nullable();
                $table->double('price', 19, 2)->default(0);
                $table->double('tax', 19, 2)->default(0);
                $table->integer('stock')->default(0);
                $table->text('description')->nullable();
                $table->unsignedInteger('device_id')->nullable();
                $table->timestamps();
                $table->engine = 'InnoDB';
                $table->foreign('device_id')->references('id')->on('devices')->onDelete('cascade');
            });

            Schema::create('invoices', function (Blueprint $table) {
                $table->increments('id');
                $table->string('invoice_number')->unique();
                $table->unsignedInteger('device_id')->nullable();
                $table->unsignedInteger('customer_id')->nullable();
                $table->unsignedInteger('admin_id')->nullable();
                $table->unsignedInteger('condition_id')->nullable();
                $table->boolean('confirmed')->default(0);
                $table->timestamps();
                $table->engine = 'InnoDB';
                $table->foreign('device_id')->references('id')->on('devices')->onDelete('cascade');
                $table->foreign('customer_id')->references('id')->on('users')->onDelete('cascade');
                $table->foreign('admin_id')->references('id')->on('users')->onDelete('cascade');
                $table->foreign('condition_id')->references('id')->on('conditions')->onDelete('cascade');
            });

            Schema::create('invoice_detail', function (Blueprint $table) {
                $table->increments('id');
                $table->unsignedInteger('invoice_id');
                $table->unsignedInteger('part_id');
                $table->double('price', 19, 2)->default(0);
                $table->double('tax', 19, 2)->default(0);
                $table->integer('qty')->default(0);
                $table->double('total', 19, 2)->default(0);
                $table->timestamps();
                $table->engine = 'InnoDB';
                $table->foreign('invoice_id')->references('id')->on('invoices')->onDelete('cascade');
                $table->foreign('part_id')->references('id')->on('parts')->onDelete('cascade');
            });

        }

        /**
         * Reverse the migrations.
         *
         * @return void
         */
        public function down()
        {   

            Schema::dropIfExists('invoice_detail');
            Schema::dropIfExists('invoices');
            Schema::dropIfExists('parts');
            Schema::dropIfExists('device_condition');
            Schema::dropIfExists('devices');
            Schema::dropIfExists('models');
            Schema::dropIfExists('gadgets');
            Schema::dropIfExists('conditions');
            Schema::dropIfExists('sizes'); 
            Schema::dropIfExists('carriers'); 
            Schema::dropIfExists('colors'); 
            Schema::dropIfExists('brands');   
        }

    }
