var app = new Vue({
    el: '#app',
    data: data,
    computed: {
    },
    methods: {

        fetchTickets: function() {
            this.$http.get("http://localhost//api.php")
            .then(function(response){
                return response.json();
            }, function(response){
                return {error: true, status: response.status};
            })
            .then(function(data){
                if(data.error) {
                    // gestion des erreurs
                    this.error = "Une erreur est survenue"
                } else {
                    // gestion du cas nominal
                    this.list = data
                }
            });
        },

        changeStatut: function(ticket, event){

            this.error = null;
            // Changement du statut : FRONT
            // Pour les appels au back utiliser le template suivant

            let postData = new FormData();
            postData.append('ticket', JSON.stringify(ticket));
            postData.append('newStatus', event.target.value);

            this.$http.post("http://localhost//api.php?action=/update", postData).then(function(response){
                return response.json();
            }, function(response){
                return {error: true, status: response.status};
            }).then(function(data){
            if(data.error) {
                // gestion des erreurs
                this.error = data.error
            } else {
                // gestion du cas nominal
                ticket.status = event.target.value
                // on peut aussi tout recharger au besoin avec :
                // this.fetchTickets()
            }
            });

        },
        addTicket: function(){
            // Ajout nouveau ticket : FRONT
            let postData = new FormData();
            postData.append('ticket', JSON.stringify(this.newTicket));

            this.$http.post("http://localhost//api.php?action=/new", postData).then(function(response){
                return response.json();
            }, function(response){
                return {error: true, status: response.status};
            })
            .then(function(data){
                if(data.error) {
                    // gestion des erreurs
                    this.error = data.error
                } else {
                    // gestion du cas nominal
                    this.list = data
                    // on peut aussi tout recharger au besoin avec :
                    // this.fetchTickets()
                }
            });

            this.newTicket = {
                title: null,
                category: "Bug",
                content: null
            }
        }
    },
    created: function(){
        this.list = [];

        this.list.forEach(ticket => {
            ticket.created_date = moment(ticket.created_date).format('L')
        });
    },
    mounted: function() {
        this.fetchTickets();
    }
  });
