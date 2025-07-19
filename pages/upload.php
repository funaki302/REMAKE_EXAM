<?php
include("header.php");
$categories = get_list_categorie();
?>
<style>
  .form-group {
    margin-bottom: 20px;
  }

  .form-group label {
    display: block;
    margin-bottom: 6px;
    color: #ccc;
  }

  .form-group input[type="text"],
  .form-group textarea,
  .form-group input[type="file"] {
    width: 100%;
    padding: 10px;
    border: 1px solid #444;
    border-radius: 6px;
    background-color: #2a2a2a;
    color: white;
    font-size: 15px;
  }

  .form-group input[type="file"] {
    padding: 6px;
  }

  .form-group textarea {
    resize: vertical;
    height: 80px;
  }

  .btn-upload {
    width: 100%;
    padding: 12px;
    background-color: #00ffff;
    color: black;
    font-weight: bold;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    transition: background-color 0.3s ease;
  }

  .btn-upload:hover {
    background-color: #00cccc;
  }

  .back-link {
    text-align: center;
    margin-top: 20px;
    font-size: 14px;
  }

  .back-link a {
    color: #00ffff;
    text-decoration: none;
  }

  .back-link a:hover {
    text-decoration: underline;
  }
</style>
</head>

<body>
  <main>
    <div class="container">
      <h2>Nouvelle Object a Integrer</h2>
      <form action="uploader.php" method="post" enctype="multipart/form-data">
        <div class="form-group">
          <label for="title">Nom</label>
          <input type="text" id="title" name="nom_objet" placeholder="Nomm de votre object" required>
        </div>
        <div class="form-group">
          <label for="description">Categories</label>
          <select name="categorie" id="">
            <?php foreach($categories as $category): ?>
              <option value="<?= $category['id_categorie'] ?>"><?= $category['nom_categorie'] ?></option>
            <?php endforeach; ?>
          </select>
        </div>
        <div class="form-group">
          <label for="media">Fichier (image)</label>
          <input type="file" id="media" name="media" accept="image/*" required>
        </div>
        <button type="submit" class="btn-upload">Publier</button>
      </form>
    </div>
  </main>
  <?php
  include("footer.php");
  ?>