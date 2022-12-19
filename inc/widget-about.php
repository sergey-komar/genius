<?php

class Geniuswp_About_Widget extends WP_Widget{

    function __construct(){
        parent::__construct('geniuswp_About_Widget',esc_html__('about widget','geniuswp'),array('description'=>esc_html__('Первый виджет','geniuswp')));
    }

    public function widget($args, $instance){
//frontend
        extract($args);

        $title = apply_filters('widget_title', $instance['title']);
        $text = apply_filters('the_content', $instance['text']);

        echo $before_widget;

        if($title){
            echo $before_title . ($title) . $after_title;
        }

        if($text){
            echo wp_kses_post($text);
        }
       
        echo $after_widget;
    }

    public function form($instance){
//backend
        if(isset($instance['title'])){
            $title = $instance['title'];
        }else{
            $title = '';
        }

        if(isset($instance['text'])){
            $text = $instance['text'];
        }else{
            $text = '';
        }
    ?>
        <p>
            <label for="<?php echo $this -> get_field_id('title')?>">title</label>
            <input class="widefat" id="<?php echo $this -> get_field_id('title')?>" name="<?php echo $this -> get_field_name('title')?>" value="<?php echo $title?>" type="text">
        </p>

        <p>
            <label for="<?php echo $this -> get_field_id('text')?>">text</label>
            <input class="widefat" id="<?php echo $this -> get_field_id('text')?>" name="<?php echo $this -> get_field_name('text')?>" value="<?php echo $text?>" type="text">
        </p>
    <?php  }

    public function update($new_instance, $old_instance){
        $instance = $old_instance;

        $instance['title'] = strip_tags($new_instance['title']);
        $instance['text'] = strip_tags($new_instance['text']);

        return $instance;
    }
}