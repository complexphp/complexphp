# Welcome to Complex PHP 0.1 Beta Version

Complex PHP v-0.1 is modified version of PHP  to make PHP and HTML more easier and responsive.


# Why Complex PHP
There are many reasons to use Complex PHP like:-

- Include various of Basic Functions, Regex Function, SQL Functions and HTML functions.
- Better experience in writing HTML with many html functions to make your work more professional.


# Getting Started

## Installation

Just include Complex PHP file in your php at the top of file.

    include "complex.php"

## Basic Functions and Examples

A simple example to use Complex PHP with html.

**index.php**

    <?php
	    
	    include "complex.php";
		
		
		html('home.php');
	?>

Now We need home.php to load html file, ***Remember you can also use home.html file but this is highly not recommended due security issues.***

**home.php**

    <html>
    
	    <body>
			
			<div class="myClass"></div>
			
	    </body>
	
	</html>
		
Now, When we load **index.php** file it will give output like this :-

    <html><body><div class="myClass"></div></body></html>

As, We can see above output is different than our assumption but don't worry using `html()` function will minify whole html file code.

Let's see unminfied output to understand more:-

**index.php**
    
    <html>
    
	    <body>
			
			<div class="myClass"></div>
			
	    </body>
	
	</html>

 This output is now completly cleaned to understand now let's try some more functions to make html easier and proffesional.
    

## How to write PHP in html file.

Calling `html()` will allow you to load html file in PHP but here is the question **How We are going to write PHP in our html file?**

Let's have a look :-

**home.php**
 
	<html>
	   
	   <?php
		    echo "This is php code";
	   ?>
	    
	    <body>
			
			<div class="myClass"></div>
			
	    </body>
	
	</html>

Yeah, I am sure you know this already *but in complex php **you can also write your php by using square brackets `[]` in html file**, Lets have a look :-*

**home.php**

    <html>
	   
	  [
		    echo "This is php code";
	  ]
	    
	    <body>
			
			<div class="myClass"></div>
			
	    </body>
	
	</html>

Yeah this is really cool, So lets explore more complex php features which will really impress you.

## **Use shortcode for functions**

You can save your time by using short functions in `[]`.

 For example if you want to echo some text, You can use this :-

    [e: This is echo]

**home.php**

    <html>
	   
	 [e: This is echo]
	    
	    <body>
			
			<div class="myClass"></div>
			
	    </body>
	
	</html>
**Output: home.php (Clean)**

    <html>
	   
	 This is echo
	    
	    <body>
			
			<div class="myClass"></div>
			
	    </body>
	
	</html>

Makesure you understood many of basic concepts of complex php, Now lets know some conditions of complex php `[]`.

**1. You can use `[]` and `<?php ?>`  both in your html code file.**

**home.php**

    <html>
		<body>
			<h1>
				<?php 
					echo "This is H1";
				?>
			</h1>
			<h1>
				[
					echo "This is H1";
				]
			</h1>
		</body>
	</html>
**2. You can't use `[]` in  html file for html, javascript or css code, It will throw error.**

For example:-

**home.php**

    <html>
		<body>
			<style>
				input[type=text]
				{	
					background:pink;
				}
			</style>
		
			<input type="text" value="green"></input>
			
		</body>
	</html>

If you use `[]` for html, css or js like this:-

		   <style>
				input[type=text]
				{	
					background:pink;
				}
			</style>
It will throw error, **So to prevent this error and use `[]` for html, css and js you have to use double square brackets `[[]]` like this :-**

       <style>
				input[[type=text]]
				{	
					background:pink;
				}
		</style>
Don't worry output will be same as we want :-

        <style>
				input[type=text]
				{	
					background:pink;
				}
		</style>
Let's understand with better example:-

    <html>
		<body>
			<style>
				input[[type=text]]
				{	
					background:pink;
				}
			</style>
		
			<input type="text" value="green"></input>
			
			<h1>I like Sea Foods [[Fish]]</h1> // Output: I like Sea Foods [Fish] 
			
			<h1>[[e: Fish]]</h1> // Output: [e: Fish]
			
			<h1>[e: Fish]</h1> // Output: Fish
			
			
			<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
			
			<script>
				
				$('h1')[[0]].css('background', 'green'); 
				
				// Output: $('h1')[0].css('background', 'green');
			
			</script>
			
		</body>
	</html>

So In easy words using `[]` will return to complex php but using `[[]]` will return to `[]` .

**3. You can't use `;` in short codes.**

If you use `;`  in short codes it will return error,

    [e: MyText;] // Will throw error

To prevent this use `;.`  or nothing.

    [e: MyText] // output: MyText
    [e: MyText;.] // output: MyText

Keep in mind, above rule is just for complex php short codes not for php code.

    [echo "MyText";] //output: MyText
    [echo "MyText";.] // Will throw error

**So In easy words `;.` is just used for complex php short codes.**

    [e: "MyText"][e: "World"] // output: MyTextWorld
    
    [e: "MyText";. e: "World"] // output: MyTextWorld
	
	[e: "MyText";. echo "World";] // output: MyTextWorld
	
	[echo "Hello"; e: "MyText";. echo "World";] // output HelloMyTextWorld
    
So from above example, Hope you understood everythings about shortcode complex php.

**4. You can't use `[]` under complex php double brackets.**

    [echo $_GET['q']; // Output: Error

You can't use square brackets `[]` under complex php square brackets.

If you want to use square brackets `[]` use `[[]]`to prevent error.

    [echo $_GET[['q']]; ] // Output: $_GET['q']

Or, Just use php tag `<?php ?>` use square brackets `[]`.

    <?php
    
	    echo $_GET['q'];
	    
	 ?>

*From above example, *We can understand that square brackets `[]` can be used under `<?php ?>` tags but If you want to use in complex php bracket use `[[]]`.**

## Complex Functions

Complex Functions will really make complexity to easy. So lets know about complex functions.

|Function|Use|Parameter
|--|--|--|
|`e()`|`e()` is used to echo string.|`e(string)`
|`c()`  |`c()` is used to hide class name of html element or javascript function name.|`c(string)`
|`randomToken()` | `randomToken()` is used to generate random token.|`randomToken(length, chars)`
`
