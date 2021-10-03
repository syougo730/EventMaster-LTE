
    <?php
        use Illuminate\Support\Facades\Schema;
        use Illuminate\Database\Schema\Blueprint;
        use Illuminate\Database\Migrations\Migration;
        
        class CreatePbScoresTable extends Migration
        {
            /**
             * Run the migrations.
             *
             * @return void
             */
            public function up()
            {
                Schema::create("pb_scores", function (Blueprint $table) {

						$table->increments('id');
						$table->integer('event_id')->unsigned();
						$table->integer('athlete_id')->unsigned();
						$table->integer('team_id')->unsigned();
						$table->integer('member_flag');
						$table->float('d_score')->nullable();
						$table->float('e_score');
						$table->float('nd_score');
						$table->timestamps();
						//$table->foreign("event_id")->references("id")->on("events");
						//$table->foreign("athlete_id")->references("id")->on("athletes");
						//$table->foreign("team_id")->references("id")->on("teams");



						// ----------------------------------------------------
						// -- SELECT [pb_scores]--
						// ----------------------------------------------------
						// $query = DB::table("pb_scores")
						// ->leftJoin("events","events.id", "=", "pb_scores.event_id")
						// ->leftJoin("athletes","athletes.id", "=", "pb_scores.athlete_id")
						// ->leftJoin("teams","teams.id", "=", "pb_scores.team_id")
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
                Schema::dropIfExists("pb_scores");
            }
        }
    