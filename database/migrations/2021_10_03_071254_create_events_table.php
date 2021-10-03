
    <?php
        use Illuminate\Support\Facades\Schema;
        use Illuminate\Database\Schema\Blueprint;
        use Illuminate\Database\Migrations\Migration;
        
        class CreateEventsTable extends Migration
        {
            /**
             * Run the migrations.
             *
             * @return void
             */
            public function up()
            {
                Schema::create("events", function (Blueprint $table) {

						$table->increments('id');
						$table->bigInteger('user_id')->unsigned();
						$table->integer('rule_id')->unsigned();
						$table->text('event_name')->nullable();
						$table->timestamps();
						

                    //*********************************
                    // Foreign KEY [ Uncomment if you want to use!! ]
                    //*********************************
                        //$table->foreign("user_id")->references("id")->on("users");
						//$table->foreign("rule_id")->references("id")->on("event_rules");



						// ----------------------------------------------------
						// -- SELECT [events]--
						// ----------------------------------------------------
						// $query = DB::table("events")
						// ->leftJoin("users","users.id", "=", "events.user_id")
						// ->leftJoin("event_rules","event_rules.id", "=", "events.rule_id")
						// ->get();
						// dd($query); //For checking



                });
            }

            /**
             * Reverse the migrations.
             *
             * @return void
             */
            public function down()
            {
                Schema::dropIfExists("events");
            }
        }
    