<?php
require(__DIR__.DIRECTORY_SEPARATOR.'CreditCardType.php');
class CreditCardTypeTests extends PHPUnit_Framework_TestCase
{
    public function Visa()
    {
        return array(
            array('4154006511889720'),
            array('4276620010591042'),
        );
    }
    
    public function MasterCard()
    {
        return array(
            array('5136910128214356'),
            array('5157830000131896'),
            array('5308170255033523'),
        );
    }

    public function Unknown()
    {
        return array(
            array('639002629002407350'),
        );
    }

    /**
     * @test
     * @dataProvider Visa
     */
    public function itShouldDetermineVisaCards($card_number)
    {
        $this->assertCardTypeEquals('VISA', $card_number);
    }

    /**
     * @test
     * @dataProvider MasterCard
     */
    public function itShouldDetermineMasterCardCards($card_number)
    {
        $this->assertCardTypeEquals('MasterCard', $card_number);
    }

    /**
     * @test
     * @dataProvider Unknown
     */
    public function itShouldDetermineUnknownCards($card_number)
    {
        $this->assertCardTypeEquals(false, $card_number);
    }

    protected function assertCardTypeEquals($expected_type, $card_number)
    {
        $this->assertSame(
            $expected_type, 
            CreditCardType::getFromNumber($card_number)
        );
    }


}
