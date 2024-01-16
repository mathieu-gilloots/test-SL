<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">

    <title>Dashboard - Test Smartloc</title>
  </head>
  <body>
    <div id="app" class="container">
      <h1>Voici la liste des tickets :</h1>
      <div class="alert alert-danger" v-if="error != null" role="alert">
        {{ error }}
      </div>
      <table class="table table-sm">
        <thead>
          <tr>
            <th scope="col">Id</th>
            <th scope="col">Titre</th>
            <th scope="col">Contenu</th>
            <th scope="col">Catégorie</th>
            <th scope="col">Date de création</th>
            <th scope="col">Status</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for='ticket in list'>
            <th scope="row">{{ ticket.id }}</th>
            <td>{{ ticket.title }}</td>
            <td>{{ ticket.content }}</td>
            <td>{{ ticket.category }}</td>
            <td>{{ ticket.created_date }}</td>
            <td>
              <select :value="ticket.status" @change="changeStatut(ticket, event)">
                <option value='todo'>A Faire</option>
                <option value='done'>Fait</option>
              </select>
            </td>
          </tr>
        </tbody>
      </table>

      <h1>Ajouter un ticket</h1>

      <form>
        <div class="form-group">
          <label for="newTicketTitle">Titre</label>
          <input type="text" v-model="newTicket.title" class="form-control" id="newTicketTitle" placeholder="Mon nouveau ticket">
        </div>
        <div class="form-group">
          <label for="newTicketCategory">Catégorie</label>
          <select v-model="newTicket.category" class="form-control" id="newTicketCategory">
            <option>Bug</option>
            <option>Nouvelle fonctionnalité</option>
          </select>
        </div>
        <div class="form-group">
          <label for="newTicketContent">Contenu du ticket</label>
          <textarea v-model="newTicket.content" class="form-control" id="newTicketContent" rows="3"></textarea>
        </div>
        <button type="button" class="btn btn-primary" @click="addTicket">Créer</button>
      </form>

    </div>


    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <!-- moment.js-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.30.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.30.1/locale/fr.min.js"></script>
    <!-- Vue.js -->
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/vue@2.5.13"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/vue-resource@1.3.5"></script>



    <script type="text/javascript">
        var data = {
          list: [],
          error: null,
          newTicket: {
            title: null,
            category: "Bug",
            content: null
          }
        };
    </script>

  <script type="text/javascript" src="app.js"></script>
  </body>
</html>