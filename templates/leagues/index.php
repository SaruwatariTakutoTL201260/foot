<!-- BootstrapのCSSを読み込み -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

<!-- スマホ用画面 -->
<div class="d-md-none">
  <?php foreach ($result['response']['data'] as $row): ?>
    <div class="card mb-3">
      <div class="card-body">
        <h5 class="card-title"><?php echo $row['name']; ?></h5>
        <a href="/football/teams/view/<?php echo $row['id']; ?>" class="btn btn-primary d-block mb-2">チーム詳細</a>
        <a href="/football/matchShedules/view/<?php echo $row['id']; ?>" class="btn btn-secondary d-block">試合日程</a>
      </div>
    </div>
  <?php endforeach; ?>
</div>

<!-- タブレット・PC用画面 -->
<div class="d-none d-md-block">
  <table class="table">
    <thead>
      <tr>
        <th scope="col">リーグ名</th>
        <th scope="col">国名</th>
        <th scope="col"></th>
        <th scope="col"></th>
        <th scope="col"></th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($result['response']['data'] as $row): ?>
        <tr>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['country']['converted_name']; ?></td>
            <td>
                <a href="/football/rank/view/<?php echo $row['id']; ?>" class="btn btn-secondary">順位表</a>
            </td>
            <td>
                <a href="/football/teams/index?league_id=<?php echo $row['id']; ?>" class="btn btn-primary">チーム一覧</a>
            </td>
            <td>
                <a href="/football/match-schedules/index?league_id=<?php echo $row['id']; ?>" class="btn btn-secondary">試合日程</a>
            </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>

<!-- BootstrapのJavaScriptを読み込み -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
