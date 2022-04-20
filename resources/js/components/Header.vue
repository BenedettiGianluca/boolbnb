<template>
    <header class="container-fluid" :class="{ 'is-hidden': !scrollEffect }">
        <div class="row header-container">
            <div class="col-3 headerleft" :class="{ 'pink': scrollEffect }">
                <i class="fa-brands fa-airbnb"></i>
                <span>airbnb</span>
            </div>
            <div class="col-5 headercenter d-flex flex-column align-items-center">
                <nav :class="{ 'hide': scrollEffect }">
                <ul>
                    <li><router-link :to="{ name: 'Homepage' }">Homepage</router-link></li>
                    <li><router-link :to="{ name: 'ApartmentList' }">ApartmentsList</router-link></li>
                    <li><router-link :to="{ name: 'SingleApartment' }">SingleApartment</router-link></li>
                </ul>
                </nav>
                <div class="container-fluid m-auto" >
                <div class="row d-flex justify-content-center">
                    <div class="inputContainer col-12" :class="{ 'search': scrollEffect }">
                    <input class="col-4"  type="text">
                    <input class="col-3" type="text">
                    <input class="col-3" type="text">
                    <span class="col-2"><i class="fa-solid fa-magnifying-glass searchIcon"></i></span>
                    </div>
                </div>
                </div>
            </div>
            <div class="headerright col-3">
                <ul>
                <li>Become a Host</li>
                <li><i class="fa-solid fa-globe"></i></li>
                <li><button><i class="fa-solid fa-bars m-2"></i><i class="fa-solid fa-user m-2"></i></button></li>
                </ul>
            </div>
        </div>
    </header>
</template>

<script>
export default {
  name: 'Header',
   data (){
     return{
        menuStatus: false,
        scrollEffect: false,
        lastScrollPosition: 0,
        scrollOffset: 0,
        links:[
       
        {
          text: "Places to visit",
          current: true,
        },
        {
          text: "Experiences",  
          current: false,
        },
        {
          text: "Online experiences",     
          current: false,
        },
        
      ]
    }
  },

  
   mounted() {
    this.lastScrollPosition = window.pageYOffset
    window.addEventListener('scroll', this.onScroll)
  },
  
  methods: {
    // Toggle if navigation is shown or hidden
    onScroll() {
      if (window.pageYOffset < 0) {
        return
      }
      
      this.scrollEffect =  this.lastScrollPosition < window.pageYOffset
      
    },
  },
  props: {
    
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped lang="scss">

header{
  position: fixed;
  top: 0;
  width: 100%;
  height: 70px;
  background-color: white;
  color: black;
  transition: .5s ease all; 
  .header-container{
    margin-top: 20px;
    display: flex;
    justify-content: space-between;
    .headerleft{
      font-size: 30px;
    }
    .headercenter{
      nav{
        ul{
          display: flex;
          list-style: none;
          li{
            margin: 10px;
            border-bottom: 1px black;
            a{
              cursor: pointer;
              color:white;  
            }
          }
        }
      }
      .inputContainer{
        border:1px solid gray;
        width: scale(1.1);
        transition: .5s ease all;
        span{
          display: flex;
          justify-content: end;
          align-items: center;
           .searchIcon{
             margin-right: 5px;
            background-color: #ff385c;
            border-radius: 50%;
            color: white;
            padding: 15px;

          }
        }
      }
    }
    .headerright{
      ul{
        list-style: none;
        display: flex;
        align-items: center;
        li{
          margin: 10px;
          button{
            border: none;
            border-radius: 35px;
            padding: 2px;
            width: 90px;
            display: flex;
            align-items: center;
            justify-content: center;
            .fa-user{
              border-radius: 50%;
              background-color: #717171;
              padding: 5px;
              color: white;
            }
          }
        }
      }
    }
  }
  .inputContainer{
    background-color: white;
    border-radius: 30px;
    height: 60px;
    padding: 3px;
    display: flex;
    align-items: center;
    input{
      border: none;
    }
  }
}
.is-hidden {
    background-image: linear-gradient(to top, rgba(0, 0, 0, 0) , rgb(16, 17, 17) 20vh, rgb(16, 17, 17)100%);
     color: white;
    transition: .5s ease all; 
    height: 190px;
}
.pink{
  color:#ff385c;
}
.hide{
  display: none;
}
.search{
  border:1px solid black;
  width: 300px; 
}

</style>

