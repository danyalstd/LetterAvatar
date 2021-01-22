# LetterAvatar
Letter Avatar compatible with Persian language for PHP

## Quick use
````php
require_once "LetterAvatar.php";
header("Content-Type: image/png"); 
createAvatar("علی محمدی");
````
Result:

<img src="https://raw.githubusercontent.com/danyalstd/LetterAvatar/main/images/normal_circle.png" width="48" height="48"/>

## Customization
### Change avatar shape
````php
$settings = array("shape"=>"square");
createAvatar("علی محمدی",$settings);
````
Result:

<img src="https://raw.githubusercontent.com/danyalstd/LetterAvatar/main/images/normal_square.png" width="48" height="48"/>

### Change background color
````php
$settings = array("background"=>"#da1327");
createAvatar("علی محمدی",$settings);
````
Result:

<img src="https://raw.githubusercontent.com/danyalstd/LetterAvatar/main/images/background.png" width="48" height="48"/>

### Add first letter of lastname
````php
$settings = array("words"=>"two");
createAvatar("علی محمدی",$settings);
````
Result:

<img src="https://raw.githubusercontent.com/danyalstd/LetterAvatar/main/images/two_word.png" width="48" height="48"/>

## Other settings
````php
$settings = array("direction"=>"rtl", // "rtl" for RTL languages like Persian, Arabic & "ltr" for other languages [default: "rtl"]
                  "shape"=>"circle", // "circle" & "square" [default: "circle"]
                  "size"=>"180", // avatar size in px [default: 120]
                  "words"=>"two", // "one" for the first letter of firstname & "two" for the first letters of firstname and lastname [default: "one"]
                  "font"=>"vazir.ttf", // location to your ttf font [default: "vazir.ttf"]
                  "fontSize"=>"60", // font size of the text [default: 1/3*(image size) (recommended)]
                  "background"=>"#da1327" // background color of avatar [default: random by user name]
                  );
````
