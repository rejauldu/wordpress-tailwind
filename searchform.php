<form id="searchform" action="<?php echo home_url( '/' ); ?>">
    <div>
        <input type="text" value="" name="s" placeholder="<?php the_search_query(); ?>" />
        <button type="submit"><?php echo getSVG('/assets/images/svg/magnifying-glass.svg');?></button>
    </div>
</form>