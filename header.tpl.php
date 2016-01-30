<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN"
  "http://www.w3.org/TR/REC-html40/loose.dtd">
<html>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimal-ui">
	
    <link rel="stylesheet" href="css/style.css">

</head>
<body>
<div class="content">    
    <main>    
    <section class="form-section">
      <h1 class="headline">Home Search</h1>
      <form class="search-form" id="search_form" method="POST" action="">
        <div>
          <div class="search-input">
            <input type="text" name="address" id="address" placeholder="Home address" class="form-input" value="<?php echo $_POST['address']; ?>" required />
          </div>
          <div class="location-input">
            <input type="text" name="citystatezip" id="citystatezip" class="form-input" value="<?php echo $_POST['citystatezip']; ?>" placeholder="City, State, Zipcode"  required />
          </div>
        </div>
        <div class="form-submit">
          <button type="submit">Search home</button>
        </div>
      </form>
    </section>