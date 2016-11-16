<?php
$image = null;
if (!empty($puzzle_column['image'])) {
    $image_args = array(
        'class' => 'pz-team-member-picture'
    );
    $image = wp_get_attachment_image($puzzle_column['image'], 'full', false, $image_args);
}

$name = (!empty($puzzle_column['name']) ? $puzzle_column['name'] : null);
$title = (!empty($puzzle_column['title']) ? $puzzle_column['title'] : null);
$content = apply_filters('ppb_like_the_content', $puzzle_column['content']);

$contact_info = '';

if (!empty($puzzle_column['phone']) || !empty($puzzle_column['email'])) {
    $contact_info .= '<div class="pz-team-member-contact-info">';
    $contact_info .= (!empty($puzzle_column['phone']) ? '<p><i class="fa fa-phone"></i>' . $puzzle_column['phone']. '</p>' : '');
    
    if (!empty($puzzle_column['email'])) {
        $contact_info .= '<p><i class="fa fa-envelope-o"></i>';
        $contact_info .= '<a href="mailto:' . $puzzle_column['email'] . '">';
        $contact_info .= $puzzle_column['email']; 
        $contact_info .= '</a>';
        $contact_info .= '</p>';
    }
    
    $contact_info .= '</div>';
}

$social_media = '';

$social_links = array_filter(array(
    'facebook'      => (!empty($puzzle_column['facebook']) ? $puzzle_column['facebook'] : ''),
    'twitter'       => (!empty($puzzle_column['twitter']) ? $puzzle_column['twitter'] : ''),
    'linkedin'      => (!empty($puzzle_column['linkedin']) ? $puzzle_column['linkedin'] : '')
));

if (!empty($social_links)) {
    $social_media .= '<div class="pz-social-links">';
    
    foreach($social_links as $soc => $link) {
        $soc_name = ppb_humanize($soc);
        $social_media .= '<a href="' . $link . '" target="_blank" title="' . $soc_name . '" aria-label="' . $soc_name . '"><i class="fa fa-' . $soc . '-square" aria-hidden="true"></i></a>';
    }
    
    $social_media .= '</div>';
}

?>

<?php if ($puzzle_options_data['layout'] == 'rows') : ?>
    <div class="column xs-12 pz-team-member-row">
        <?php if (!empty($image)) : ?>
        <div class="column xs-12 sm-5 md-4 lg-3">
            <div class="col-inner">
                <?php echo $image; ?>
            </div>
        </div>
        <?php endif; ?>
        
        <div class="column xs-12<?php if ($image) echo ' sm-7 md-8 lg-9'; ?> pz-team-member-content">
            <div class="col-inner">
                <?php
                if ($name) echo '<h3>' . $name . '</h3>';
                if ($title) echo '<h4>' . $title . '</h4>';
                echo $content . $contact_info . $social_media;
                ?>
            </div>
        </div>
    </div>
<?php else : ?>
    <div class="column <?php echo ppb_span_classes($puzzle_columns_num); ?> pz-team-member-columns">
        <div class="col-inner">
            <?php if (!empty($image)) echo $image; ?>
            <div class="pz-team-member-content">
                <?php
                if ($name) echo '<h4>' . $name . '</h4>';
                if ($title) echo '<h5>' . $title . '</h5>';
                echo $content . $contact_info . $social_media;
                ?>
            </div>
        </div>
    </div>
<?php endif; ?>
