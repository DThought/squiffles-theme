<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <title><?php
if (is_singular()) {
  echo the_title() . ' - ';
}
?>Blog - Deep Toaster</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="/bin/fonts/flaticon.css" type="text/css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Raleway:800%7CTitillium+Web:400,700" type="text/css" rel="stylesheet" />
    <link href="/squiffles.css" type="text/css" rel="stylesheet" />
    <script async="async" src="https://www.googletagmanager.com/gtag/js?id=UA-168811289-1"></script>
    <script src="/bin/js/ga.js"></script>
<?php
wp_head();
?>  </head>
  <body>
    <div id="header">
      <div class="pull-right">
        <a href="/blog/">Blog</a>
        <a href="/resume/">Resume</a>
      </div>
      <h1>
        <a href="/">Deep Toaster</a>
      </h1>
    </div>
    <div id="sidebar">
      <ul>
<?php
dynamic_sidebar();
?>      </ul>
    </div>
    <div id="main">
      <dl class="timeline">
<?php
while (have_posts()) {
  the_post();
  $date = get_the_date('j M');
  $categories = get_the_category();

  echo <<<EOF
        <dt>$date</dt>
        <dd>

EOF;

  foreach ($categories as $category) {
    $category_link = get_category_link($category);

    echo <<<EOF
          <a class="post-category post-category-$category->slug" href="$category_link" rel="category">$category->name</a>

EOF;
  }

  echo <<<EOF
          <div class="post">
            <h2 class="post-title">
EOF;

  if (is_single()) {
    the_title();
  } else {
    $permalink = get_permalink();
    the_title("<a href=\"$permalink\" rel=\"bookmark\">", '</a>');
  }

  echo <<<EOF
</h2>
            <div class="post-content">

EOF;

  the_content();
  the_tags('<p>Tags: ', ', ', '</p>');

  echo <<<EOF

              <p>
EOF;

  edit_post_link();
  $comments_id = is_single() ? ' id="comments"' : '';

  echo <<<EOF
              </p>
            </div>
            <ul$comments_id class="post-comments">

EOF;

  if (is_single()) {
    comments_template();
  } else {
    echo <<<EOF
              <li>
                <div class="comment-respond">
EOF;

    comments_popup_link();

    echo <<<EOF
                </div>
              </li>

EOF;
  }

  echo <<<EOF
            </ul>
          </div>
        </dd>

EOF;
}

the_posts_navigation();
?>
      </dl>
    </div>
  </body>
</html>
