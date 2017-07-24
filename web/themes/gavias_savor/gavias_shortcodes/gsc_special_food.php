<?php 
namespace Drupal\gavias_blockbuilder\shortcodes;
if(!class_exists('gsc_special_food')):
   class gsc_special_food{

      public function render_form(){
         $fields = array(
            'type' => 'gsc_special_food',
            'title' => ('Special Food Item'), 
            'size' => 3,'fields' => array(
         
               array(
                  'id'        => 'title',
                  'type'      => 'text',
                  'title'     => t('Title'),
                  'class'     => 'display-admin'
               ),
               array(
                  'id'        => 'image',
                  'type'      => 'upload',
                  'title'     => t('Icon image'),
               ),
               array(
                  'id'        => 'content',
                  'type'      => 'textarea',
                  'title'     => t('Content'),
                  'desc'      => t('Some Shortcodes and HTML tags allowed'),
               ),
               array(
                  'id'        => 'link',
                  'type'      => 'text',
                  'title'     => t('Link'),
                  'desc'      => t('Link for text')
               ),
               array(
                  'id'        => 'link_title',
                  'type'      => 'text',
                  'title'     => t('Link Title'),
                  'desc'      => t('Title for link'),
                  'std'       => t('Read more')
               ),
               array(
                  'id'        => 'animate',
                  'type'      => 'select',
                  'title'     => t('Animation'),
                  'desc'      => t('Entrance animation for element'),
                  'options'   => gavias_blockbuilder_animate(),
               ),
               array(
                  'id'     => 'el_class',
                  'type'      => 'text',
                  'title'  => t('Extra class name'),
                  'desc'      => t('Style particular content element differently - add a class name and refer to it in custom CSS.'),
               ),

            ),                                       
         );
         return $fields;
      }

      public function render_content( $item ) {
         if( ! key_exists('content', $item['fields']) ) $item['fields']['content'] = '';
         print self::sc_special_food( $item['fields'], $item['fields']['content'] );
      }


      public static function sc_special_food( $attr, $content = null ){
         extract(shortcode_atts(array(
            'title'           => '',
            'image'           => '',
            'link'            => '',
            'link_title'      => '',
            'link'            => '',
            'animate'         => '',
            'el_class'        => ''
         ), $attr));

         if($image){
            $image = substr(base_path(), 0, -1) . $image; 
         }

         $class = array();
         if($el_class) $class[] = $el_class;
         if($animate){
            $class[] = 'wow';
            $class[] = $animate;
         }

         ?>
         <?php ob_start() ?>
         <div class="widget gsc-special-food <?php if(count($class)>0) print implode($class, ' ') ?>">
            <?php if($image){ ?>
               <div class="image"><img src="<?php print $image ?>" alt=""/>
                  <?php if($link){ ?> <a class="link btn-theme" href="<?php echo $link ?>"> <?php } ?><?php echo $link_title ?><?php if($link){ ?> </a> <?php } ?>
               </div>
            <?php }?>
            <div class="box-content">
               <h4>
                  <?php if($link){ ?> <a class="title" href="<?php echo $link ?>"> <?php } ?>
                     <?php print $title; ?>
                  <?php if($link){ ?> </a> <?php } ?>
               </h4>
               <div class="desc"><?php print do_shortcode($content); ?></div>
            </div>
         </div> 
         <?php return ob_get_clean() ?>
       <?php
      }

      public function load_shortcode(){
         add_shortcode( 'special_food', array($this, 'sc_special_food') );
      }
   }
endif;   




