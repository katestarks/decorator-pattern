<?php

// The component interface defines operations that can be
// altered by decorators.

interface CoffeeList {
    function coffeeDescription();
    function sendCoffees();
}

class CoffeesToSend implements CoffeeList {
    function coffeeDescription(){
        return "filter-style coffee";
    }
    function sendCoffees(){
    }
}

// The abstract class CoffeesToSend implements the Coffee interface. We re-define the interface methods as abstract methods.
//The abstract class also holds a reference to an object that was created from one of the basic classes.

abstract class CoffeeNews implements CoffeeList {
    protected $coffeeContacts;

    function __construct(CoffeeList $readyToSend)
    {
        $this->coffeeContacts = $readyToSend;
    }

    abstract function coffeeDescription();
    abstract function sendCoffees();
}

// Add concrete class Email which extends the CoffeeFeatures decorator

class Email extends CoffeeNews {
    function coffeeDescription(){
        return "May's new " . $this->coffeeContacts->coffeeDescription() . ", just in. ";
    }

    function sendCoffees(){
        return $this->coffeeContacts->sendCoffees() . "These are sent by e-mail";
    }
}

// Add concrete class Text which extends the CoffeeFeatures decorator

class TextMess extends CoffeeNews {
    function coffeeDescription(){
        return $this->coffeeContacts->coffeeDescription();
    }

    function sendCoffees(){
        return $this->coffeeContacts->sendCoffees() . " and by text.";
    }
}

$readyToSend = new CoffeesToSend();
$sendByEmail = new Email($readyToSend);
$textAsWell = new TextMess($sendByEmail);

echo $textAsWell->coffeeDescription();
echo $textAsWell->sendCoffees();