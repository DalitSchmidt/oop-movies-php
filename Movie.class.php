<?php

class Movie {
    private $name;
    private $year;
    private $author;

    /**
     * @param $name
     * @param $year
     * @param $author
     * @throws InvalidArgumentException
	 **/
    public function __construct( $name, $year, $author ) {
        $this->setName( $name );
        $this->setYear( $year );
        $this->setAuthor( $author );
    }

    /**
     * @return mixed
	 **/
    public function getName() {
        return $this->name;
    }

    /**
     * @param mixed $name
	 **/
    public function setName( $name ) {
        if ( strlen( $name ) < 2 )
            throw new InvalidArgumentException('Movie name must be at least 2 letters');

        $this->name = ucfirst( $name );
    }

    /**
     * @return mixed
	 **/
    public function getYear() {
        return $this->year;
    }

    /**
     * @param $year
     * @throws InvalidArgumentException
	 **/
    public function setYear( $year ) {
        if ( strlen( $year ) != 4  )
            throw new InvalidArgumentException('Year must be 4 letters');

        $this->year = $year;
    }

    /**
     * @return mixed
     **/
    public function getAuthor() {
        return $this->author;
    }

    /**
     * @param mixed $author
	 **/
    public function setAuthor( $author ) {
        if ( strlen( $author ) < 2  )
            throw new InvalidArgumentException('Author must be at least 2 letters');

        $this->author = ucfirst( $author );
    }

    /**
     * @return string
     */
    public function __toString() {
        return "Movie name: {$this->getName()}, at year: {$this->getYear()}. Author: {$this->getAuthor()}";
    }

    /**
     * @return string
	 **/
    private function toJSON() {
        return json_encode( ["name" => $this->getName(), "year" => $this->getYear(), "author" => $this->getAuthor()] );
    }

    /**
     * @return boolean
	 */
    public function save() {
        $new_name = strtolower( str_replace(' ', '-', $this->getName()) );
        return (bool)@file_put_contents('data/' . $new_name . '.json', $this->toJSON());
    }
}