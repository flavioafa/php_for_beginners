    <?php 

    $books = [
        [
            "name" => "Do Android Dreams of Eletric Sheep",
            "author" => "Philip K. Dick",
            "purchaseUrl" => "http://www.books.com/id=1",
            "releaseYear" => 1968
        ],
        [
            "name" => "The Martian",
            "author" => "Andy Weir",                
            "purchaseUrl" => "http://www.books.com/id=2",
            "releaseYear" => 2011
        ],
        [
            "name" => "Project Hail Mary",
            "author" => "Andy Weir",
            "purchaseUrl" => "http://www.books.com/id=3",
            "releaseYear" => 2021
        ]
    ];

    function filter($items, $fn){
        $filteredItems = [];
        foreach($items as $item){
            if($fn($item)){
                $filteredItems[] = $item;
            }
        }
        return $filteredItems;
    }

    //Lambda function
    // $filteredBooks = filter($books, function($book){
    //     return $book["releaseYear"] >= 2011;
    // });

    //Aqui mostrando usando uma função que faz a mesma coisa, sendo que usando usando a default php
    $filteredBooks = array_filter($books, function($book){
        return $book["releaseYear"] >= 2011;
    });

    require "about.view.php";