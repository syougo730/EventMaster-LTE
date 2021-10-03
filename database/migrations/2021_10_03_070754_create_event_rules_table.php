
    <?php
        use Illuminate\Support\Facades\Schema;
        use Illuminate\Database\Schema\Blueprint;
        use Illuminate\Database\Migrations\Migration;
        
        class CreateEventRulesTable extends Migration
        {
            /**
             * Run the migrations.
             *
             * @return void
             */
            public function up()
            {
                Schema::create("event_rules", function (Blueprint $table) {

						$table->increments('id');
						$table->text('rule_name')->nullable();
						$table->integer('team_members_count');
						$table->integer('playable_members_count');
						$table->integer('player_to_score_count');
						$table->timestamps();



						// ----------------------------------------------------
						// -- SELECT [event_rules]--
						// ----------------------------------------------------
						// $query = DB::table("event_rules")
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
                Schema::dropIfExists("event_rules");
            }
        }
    