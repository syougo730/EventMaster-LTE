
    <?php
        use Illuminate\Support\Facades\Schema;
        use Illuminate\Database\Schema\Blueprint;
        use Illuminate\Database\Migrations\Migration;
        
        class CreateAthletesTable extends Migration
        {
            /**
             * Run the migrations.
             *
             * @return void
             */
            public function up()
            {
                Schema::create("athletes", function (Blueprint $table) {

						$table->increments('id');
						$table->integer('event_id')->unsigned(); //大会ID
						$table->integer('team_id')->unsigned();
						$table->string('athlete_name',511)->nullable(); //選手名
						//$table->foreign("event_id")->references("id")->on("events");
						//$table->foreign("team_id")->references("id")->on("teams");



						// ----------------------------------------------------
						// -- SELECT [athletes]--
						// ----------------------------------------------------
						// $query = DB::table("athletes")
						// ->leftJoin("events","events.id", "=", "athletes.event_id")
						// ->leftJoin("teams","teams.id", "=", "athletes.team_id")
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
                Schema::dropIfExists("athletes");
            }
        }
    