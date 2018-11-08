<?php

add_action('admin_menu', 'ra_admin_contacts_options_menu');

function ra_admin_contacts_options_menu() {

	add_menu_page(
    'Brandspa theme options',
    'Contactos', //menu name
    'manage_options', //allow it options
    'ra-contacts', //slug
    'ra_contacts_options',
    get_template_directory_uri() . '/public/img/bs.png', //icon on menu
    112 //position on menu
  );
}

function ra_contacts_options() {
  global $wpdb;
  $slug = 'ra-contacts';
  $paged = isset($_GET['paged']) ? $_GET['paged'] : 0;
  $perpage = isset($_GET['perpage']) ? $_GET['perpage'] : 25;
  $postname = isset($_GET['postname']) ? $_GET['postname'] : '';
  $offset = $paged * $perpage;

  $contacts = $wpdb->get_results( "SELECT id, name, email, phone, question, company, created_at FROM contacts  ORDER BY id DESC  LIMIT ". $perpage ." OFFSET " . $offset);
  ?>

  <h2>Contactos</h2>

  <hr/>
  <table class="wp-list-table widefat fixed striped">
    <thead>
      <tr>
        <th>Email</th>
        <th>Name</th>
        <th>phone</th>
        <th>Company</th>
        <th>Message</th>
        <th>Date</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach($contacts as $contact): ?>
        <tr>
          <td><a href="mailto:<?php echo $contact->email; ?>" target="new"><?php echo $contact->email; ?></a></td>
          <td><?php echo $contact->name; ?></td>
          <td><?php echo $contact->phone; ?></td>
          <td><?php echo $contact->company; ?></td>
          <td><?php echo $contact->question; ?></td>
          <td><?php echo $contact->created_at; ?></td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
  <hr/>

  <div class="pagination">
    <a class="prev-page button" href="/wp-admin/admin.php?page=<?php echo $slug ?>&paged=<?php echo $paged > 0 ? $paged - 1 : 0 ?>">prev</a>
    <a class="next-page button" href="/wp-admin/admin.php?page=<?php echo $slug ?>&paged=<?php echo count($contacts) > 0 ? $paged + 1 :  $paged - 1 ?>">next</a>
  </div>
  <?php
  }
