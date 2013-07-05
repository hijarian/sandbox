<?php
require_once(__DIR__.'/code.php');
class BruteForceTests extends PHPUnit_Framework_TestCase 
{

    /** @test */
    public function NoLoginAttemptsNoBruteforce()
    {
        // Given empty dataset any random time will do
        $any_random_time = date('H:i');

        $this->assertFalse(
            $this->isUserTriedToBruteForce($any_random_time)
        );
    }

    /** @test */
    public function DoNotDetectBruteforceIfLessThanFiveLoginAttemptsInLastTwoHours()
    {
        $this->userLogged('5:34');
        $this->userLogged('4:05');

        $this->assertFalse(
            $this->isUserTriedToBruteForce('6:00')
        );
    }

    /** @test */
    public function DetectBruteforceIfMoreThanFiveLoginAttemptsInLastTwoHours()
    {
        $this->userLogged('4:36');
        $this->userLogged('4:23');
        $this->userLogged('4:00');
        $this->userLogged('3:40');
        $this->userLogged('3:15');
        $this->userLogged('3:01'); // ping! 6th login, just in time

        $this->assertTrue(
            $this->isUserTriedToBruteForce('5:00')
        );
    }

    //==================================================================== SETUP

    /** @var PDO */
		private static $connection;

    /** @var PDOStatement */
    private $inserter;

    const DBNAME = 'test';
    const DBUSER = 'msandbox';
    const DBPASS = 'msandbox';
    const DBHOST = '127.0.0.1';
    const DBPORT = '5612';


		public static function setUpBeforeClass()
		{
	      self::$connection = new PDO(
            sprintf('mysql:host=%s;dbname=%s;port=%s', self::DBHOST, self::DBNAME, self::DBPORT), 
            self::DBUSER, 
            self::DBPASS
        );

				self::$connection->exec('create table login_attempts (id int unsigned not null primary key auto_increment, user_id int unsigned, time timestamp)');	
		}

    public function setUp()
    {
        $this->assertInstanceOf('PDO', self::$connection);

        // Cleaning after possible previous launch
        self::$connection->exec('delete from login_attempts');

        // Caching the insert statement for perfomance
        $this->inserter = self::$connection->prepare(
            'insert into login_attempts (`user_id`, `time`) values(:user_id, :timestamp)'
        );
        $this->assertInstanceOf('PDOStatement', $this->inserter);
    }

    //================================================================= FIXTURES

    // User ID of user we care about
    const USER_UNDER_TEST = 1;
    // User ID of user who is just the noise in the DB, and should be skipped by tests
    const SOME_OTHER_USER = 2;

    /**
     * Use this method to record login attempts of the user we care about
     * 
     * @param string $datetime Any date & time definition which `strtotime()` understands.
     */ 
    private function userLogged($datetime)
    {
        $this->logUserLogin(self::USER_UNDER_TEST, $datetime);
    }

    /**
     * Use this method to record login attempts of the user we do not care about,
     * to provide fuzziness to our tests
     *
     * @param string $datetime Any date & time definition which `strtotime()` understands.
     */ 
    private function anotherUserLogged($datetime)
    {
        $this->logUserLogin(self::SOME_OTHER_USER, $datetime);
    }

    /**
     * @param int $userid
     * @param string $datetime Human-readable representation of login time (and possibly date)
     */
    private function logUserLogin($userid, $datetime)
    {
        $mysql_timestamp = date('Y-m-d H:i:s', strtotime($datetime));
        $this->inserter->execute(
            array(
                ':user_id' => $userid,
                ':timestamp' => $mysql_timestamp
            )
        );
        $this->inserter->closeCursor();
    }

    //=================================================================== HELPERS

    /**
     * Helper to quickly imitate calling of our function under test 
     * with the ID of user we care about, clean connection of correct type and provided testing datetime.
     * You can call this helper with the human-readable datetime value, although function under test
     * expects the integer timestamp as an origin date.
     * 
     * @param string $datetime Any human-readable datetime value
     * @return bool The value of called function under test.
     */
    private function isUserTriedToBruteForce($datetime)
    {
        $connection = $this->tryGetMysqliConnection();
        $timestamp = strtotime($datetime);
        return wasTryingToBruteForce(self::USER_UNDER_TEST, $connection, $timestamp);
    }
    
    private function tryGetMysqliConnection()
    {
        $connection = new mysqli(self::DBHOST, self::DBUSER, self::DBPASS, self::DBNAME, self::DBPORT);
        $this->assertSame(0, $connection->connect_errno);
        $this->assertEquals("", $connection->connect_error);
        return $connection;
    }

}
