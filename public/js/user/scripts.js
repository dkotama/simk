var vm = new Vue({
  el: "#app",
  data: {
    single: {
      name: '',
      email: '',
      phone: '',
      institution: ''
    },
    
    authors: []
  },
  
  methods: {  
    addAuthor: function() {
      var temp  = {
        name: '',
        email: '',
        phone: '',
        institution: ''
      };      
            
      this.authors.push(temp);
    }    
  },
  
  computed: {
    echoAuthor: function() {
      return this.authors;
    }
  },

  ready: function() {
    this.addAuthor();   
    // console.log(this.echoAuthor);
  },
});