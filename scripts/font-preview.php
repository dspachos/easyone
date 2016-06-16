<html>
  <head>
 <?php

 $font_tmp = $_GET['fontname'];
 $font = str_replace(' ','+', $font_tmp);

 $font_use = str_replace('%20',' ', $font_tmp);
 $font_use = str_replace(':300','', $font_use);

 ?>


    <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=<?php print $font; ?>">
    <style>
      body {
        font-family: '<?php print $font_use;?>', serif;
        font-size: 12px;
      }
    </style>
  </head>
  <body>

    <h1>Grumpy wizards make toxic brew for the evil Queen and Jack</h1>
    <p>Grumpy wizards make toxic brew for the evil Queen and Jack. One morning, when Gregor Samsa woke from troubled dreams, he found himself transformed in his bed into a horrible vermin. He lay on his armour-like back, and if he lifted his head a little he could see his brown belly, slightly domed and divided by arches into stiff sections. The bedding was hardly able to cover it and seemed ready to slide off any moment. His many legs, pitifully thin compared with the size of the rest of him, waved about helplessly as he looked. One morning, when Gregor Samsa woke from troubled dreams, he found himself transformed in his bed into a horrible vermin. He lay on his armour-like back, and if he lifted his head a little he could see his brown belly, slightly domed and divided by arches into stiff sections. The bedding was hardly able to cover it and seemed ready to slide off any moment. His many legs, pitifully thin compared with the size of the rest of him, waved about helplessly as he looked.</p>
  </body>
</html>