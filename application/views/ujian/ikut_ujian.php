<h3 id="demo">Demo</h3>
  <nav aria-label="Navigasi soal ujian">
    <ul class="pagination" role="tablist">
    <?php 
    $no = 0;
    foreach ($data as $key ) :
      $no++ ?>
      <li role="presentation"><a href="#soal-<?php echo $no; ?>" aria-control="soal-<?php echo $no; ?>" role="tab" data-toggle="tab">1</a></li>
    <?php endforeach; ?>
    </ul>
  </nav>

  <div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="soal-1">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h4 class="panel-title">1. Amet ullamco incididunt tempor sit commodo labore pariatur eiusmod nostrud exercitation proident non anim. Adipisicing et amet dolore in ut?</h4></div>
        <div class="panel-body">
          <div class="radio">
            <label>
              <input type="radio" name="jawaban[1]" id="jawaban-1a" value="a">Officia adipisicing adipisicing id qui cupidatat ipsum amet ex.</label>
          </div>
          <div class="radio">
            <label>
              <input type="radio" name="jawaban[1]" id="jawaban-1b" value="b">Aliqua voluptate anim tempor deserunt dolore aliquip nulla eiusmod sit voluptate.</label>
          </div>
          <div class="radio">
            <label>
              <input type="radio" name="jawaban[1]" id="jawaban-1c" value="c">Velit incididunt ex et veniam aute adipisicing ut consectetur reprehenderit aute qui ex ex adipisicing.</label>
          </div>
          <div class="radio">
            <label>
              <input type="radio" name="jawaban[1]" id="jawaban-1d" value="d">Aute incididunt eu laborum in sit.</label>
          </div>
          <div class="radio">
            <label>
              <input type="radio" name="jawaban[1]" id="jawaban-1e" value="e">Reprehenderit ea consectetur voluptate eu.</label>
          </div>
        </div>
      </div>
    </div>
  </div>
 