
    <?php
        use Illuminate\Support\Facades\Schema;
        use Illuminate\Database\Schema\Blueprint;
        use Illuminate\Database\Migrations\Migration;
        
        class CreateFxScoresTable extends Migration
        {
            /**
             * Run the migrations.
             *
             * @return void
             */
            public function up()
            {
                Schema::create("fx_scores", function (Blueprint $table) {

						$table->increments('id');
						$table->integer('event_id')->nullable()->unsigned();
						$table->integer('athlete_id')->unsigned();
						$table->integer('team_id')->unsigned();
						$table->integer('member_flag');
						$table->float('d_score');
						$table->float('e_score');
						$table->float('nd_score');
						$table->timestamps();
						//$table->foreign("event_id")->references("id")->on("events");
						//$table->foreign("athlete_id")->references("id")->on("athletes");
						//$table->foreign("team_id")->references("id")->on("teams");



						// ----------------------------------------------------
						// -- SELECT [fx_scores]--
						// ----------------------------------------------------
						// $query = DB::table("fx_scores")
						// ->leftJoin("events","events.id", "=", "fx_scores.event_id")
						// ->leftJoin("athletes","athletes.id", "=", "fx_scores.athlete_id")
						// ->leftJoin("teams","teams.id", "=", "fx_scores.team_id")
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
                Schema::dropIfExists("fx_scores");
            }
        }
    