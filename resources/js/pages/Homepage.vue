<template>
    <div>
        <div v-if="!loading">
            <!-- jumbotron -->
            <div class="container-fluid">
                <div class="row ms_jumbotron">
                    <div class="ms_imagecontainerJumbo col-11 col-lg-10 p-0">
                        <img  src="../../../public/storage/uploads/jubotron.jpg" alt="">
                        <div class="ms_textcontainer">
                            <h3 class="text-white ms_textJombo d-lg-none">Lasciati guidare dalla curiosità</h3>
                            <h1 class="text-white ms_textJombo d-none d-lg-block">Lasciati guidare dalla curiosità</h1>
                            <a href="/appartamenti">
                                <button>Sono flessibile</button>
                            </a>
                        </div>
                    </div>
                </div>            
            </div>

            <!-- appartamenti consigliati -->
            <div class="container-fluid ms_apartmentSlider">
                <div class="row d-flex justify-content-center">
                    <div class="col-10">
                        <h1>Appartamenti Dei Nostri Migliori Host</h1>
                        <vue-horizontal class="my-5">
                            <div class="item bg-dark">
                                <h3 class="ms_logo">
                                    <i class="fa-brands fa-airbnb"></i>
                                    <span>Boolbnb</span>
                                </h3>
                                <p class="text-dark">Easer Egg. Grazie Antony</p>
                            </div>
                            <section v-for="apartment in apartments" :key="apartment.id">
                                <div v-if="apartment.visible && apartment.active_sponsorships.length!=0">
                                    <router-link :to="{name: 'SingleApartment', params: {slug: apartment.slug}}">
                                        <div v-for="image in apartment.images" :key="image.id"><!-- non usare ccs su questo div -->
                                            <p v-if="image.main_image"  class="ms_cardImage">
                                                <img  :src="`/storage/${image.url}`"  class="border">
                                            </p>
                                        </div>
                                    </router-link>  
                                    <router-link :to="{name: 'SingleApartment', params: {slug: apartment.slug}}">
                                        <h5>{{apartment.name}}</h5>
                                    </router-link>
                                </div>
                            </section>
                            <section>
                                <h3 class="text-white">Navigation Button</h3>
                                <p class="text-white">The navigation button will appear if there is an overflow.</p>
                            </section>
                            <section>
                                <h3 class="text-white">Navigation Button</h3>
                                <p class="text-white">The navigation button will appear if there is an overflow.</p>
                            </section>
                            <section>
                                <h3 class="text-white">Scroll</h3>
                                <p class="text-white">You can just trackpad to scroll still!</p>
                            </section>
                        </vue-horizontal>
                    </div>

                </div>
            </div>
            
        
            <!-- cities cards -->
            <div class="container-fluid">
                <div class="row d-flex justify-content-center align-items-center ms_allCardsContainer">
                    <div class="ms_citiesContainer container-fluid d-flex flex-column col-10">
                        <h1 class="mb-2">Destinazioni Più Gettonate</h1>
                        <div class="row ms_citiesContainer col-12">
                            <div v-for="(element, index) in cities" :key="index" class="ms_cityCard my-3 my-lg-0"  :style="{'background-color':colors[index]}" @click="specialFilter(index)">
                                <div class="ms_imageContainer">
                                    <img :src="require('../../../public/storage/uploads/'+element.image+'.jpg') " alt="">
                                </div>
                                <div class="ms_textcity">
                                    <h1 class="text-white">{{element.title}}</h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Esperienze Boolbnb -->
            <div class="container-fluid">
                <div class="row d-flex justify-content-center">
                    <div class="col-10 ms_experienceContainer">
                        <h1>Scopri le Esperienze Boolbnb</h1>
                        <div class="ms_imgsEsp">
                            <div class="ms_imgEsp col col-lg-6">
                                <img  src="../../../public/storage/uploads/experience2.jpg" alt="">
                                <h1 class="ms_esptext text-white">Esperienze <br> per il tuo viaggio</h1>
                            </div>
                            <div class="ms_imgEsp col col-lg-6">
                                <img  src="../../../public/storage/uploads/experience1.jpg" alt="">
                                <h1 class="ms_esptext text-white">Attività <br> da casa</h1>
                            </div>  
                        </div>
                    </div>
                </div>
            </div>

            <!-- gift card  -->
            <div class="container-fluid">
                <div class="row d-flex justify-content-center p-0">
                    <div class="ms_giftContainer p-0 col-10">
                        <div class="col-12 col-lg-4 ms_giftFont">
                            <h1>Acquista <br> le gift card <br> di Airbnb</h1>
                        </div>
                        <div class="ms_giftImg col col-lg-8">
                            <img  src="../../../public/storage/uploads/gift.jpg" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <Loader v-else/>
    </div>
</template>

<script>
import Loader from "./Loader.vue";
export default {
    name: "Homepage",
    components: {
        Loader
    },
    data(){
      return{
          apartments:[],
          colors:['#DE3151', '#BC1A6E', '#CC2D4A', '#D93B30'],
          cities:[
              {
                image:"city1",
                title:"Milano",   
                lat:45.46362,
                lon:9.18812
              },
              {
                image:"city2",
                title:"Roma",
                lat:41.89056,
                lon:12.49427
              }, 
              {
                image:"city3",
                title:"Napoli",
                lat:40.83998,
                lon:14.25254
              }, 
              {
                image:"city4",
                title:"Firenze",
                lat:43.7687,
                lon:11.25693
              },     
          ],
          loading: true,
      }
      
    },
    components: {
        Loader
    },
    created() {
        axios
        .get("/api/apartments")
        .then((response) => {
            this.apartments = response.data;
             this.loading = false;
        });
    },
    props:{
        apartmentList: Array
    },
    methods:{
        specialFilter: function(index){
            console.log("partito?")
            this.$parent.$emit('specialfilter',{"search": this.cities[index].title,"lat":this.cities[index].lat,"lon":this.cities[index].lon, "beds":1, "rooms":1, "radius":20, "servicesList":"0-"});              
                        
        }
    }
}
</script>

<style lang="scss" scoped>

//jumbotron
.ms_jumbotron{
    background-color: black;
    height: 800px;
    display: flex;
    justify-content: center;
    position: relative;
    
    .ms_imagecontainerJumbo{
        margin-top: 200px;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        height: 712px;
        border-radius: 20px;
        overflow: hidden;
        img{
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .ms_textcontainer{
            position: absolute;
            bottom: 30px;
            left: 50%;
            transform:translate(-50%);
            width: 700px;
            display: flex;
            flex-direction: column;
            align-items: center;
            h1.ms_textJombo{
                font-size: 50px;
                text-align: center;
            }
            button{
                margin:15px auto;
                padding:12px 22px;
                border: none;  
                border-radius: 20px;  
                font-size: 15px;      
                color: rgb(64, 14, 64);  
                .ms_btnLeft{
                    position: absolute;
                    left: 20px;
                    top: 50%;
                    transform: translateY(-50%);
                }
            }
        }
    }
    
}
     

// appartamenti
.item {
  padding: 16px 24px;
  margin-right: 24px;
  border-radius: 4px;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  .ms_logo,
  i{
      color: #DE3151;
  }
}

.ms_apartmentSlider{
    margin: 250px 0 40px 0;
    position: relative;

    button{
        color:white;
        background: #DE3151;
        padding: 10px 15px;
        font-weight:900;
        border: 0px;
        border-radius:50%;
    }

    section{
        max-width: 320px;
        margin: 20px 0;
        text-align: center;
    }

    h5{
        max-width: 320px;
        margin: 0 10px;
    }

    a{
        color:black;
        text-decoration:none;
    }

    .ms_cardImage{
        margin-bottom:0;
        padding: 20px 0;

        img{
            height: 200px;
            width: 300px;
            border-radius: 13px;
            filter: grayscale(50%);
        }
        
        &:hover img{
            filter: grayscale(0%);
        }

    }

}

//cities cards

.ms_citiesContainer { 
    margin:30px 0;
    padding: 0;
    
    .ms_cityCard{
        width: 100%;
        border-radius: 20px;
        padding: 0;
        margin: 0 5px;
        height: 300px;
        overflow: hidden;
        cursor: pointer;

        .ms_imageContainer{
            height: 167px;
            width: 100%;
            overflow: hidden;
            img{
                width: 100%;
                object-fit: cover;
            }
        }
        .ms_textcity{
            padding: 10px 20px;
            height: 200px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
    
    }
}
@media only screen and (min-width:712px){
        .ms_citiesContainer { 
        margin:30px 0;
        padding: 0;
        .ms_flexContainer{
            display: flex;
            justify-content: space-between;
        }
        .ms_cityCard{
            width: calc(100% / 2 - 10px);
            border-radius: 20px;
            padding: 0;
            margin: 0 5px;
            height: 300px;
            overflow: hidden;
            .ms_imageContainer{
                height: 167px;
                width: 100%;
                overflow: hidden;
                img{
                    width: 100%;
                    object-fit: cover;
                }
            }
            .ms_textcity{
                padding: 10px 20px;
            }
        
        }
    } 
}
@media only screen and (min-width:1200px){
        .ms_citiesContainer { 
        margin:40px 0;
        .ms_flexContainer{
            display: flex;
            justify-content: space-between;
        }
        .ms_cityCard{
            width: calc(100% / 4 - 10px);
            border-radius: 20px;
            padding: 0;
            margin: 0 5px;
            height: 400px;
            overflow: hidden;
            .ms_imageContainer{
                height: 200px;
                width: 100%;
                overflow: hidden;
                img{
                    width: 100%;
                    object-fit: cover;
                }
            }
            .ms_textcity{
                padding: 20px;
            } 
        }
    }   
}

//experiences
.ms_experienceContainer{
    margin:78px auto;
    .ms_imgsEsp{
        width: 100%;
        .ms_imgEsp{
            padding: 20px 0;
            overflow: hidden;
            position: relative;
            img{
                width: 100%;
                border-radius: 20px;
            }
            .ms_esptext{
                position: absolute;
                top: 80px;
                left: 30px;
                font-size: 40px;
            }
        }
    }
}

@media only screen and (min-width:1200px){
        .ms_experienceContainer{
        margin:40px auto;
        .ms_imgsEsp{
            width: 100%;
            display: flex;
            justify-content: space-between;
            .ms_imgEsp{
                padding: 20px 10px;
                .ms_esptext{
                    font-size: 60px;
                    position: absolute;
                    top: 80px;
                    left: 60px;
                }
            }
        }
    }
}

//gift card
.ms_giftContainer{
    margin:50px auto;
    .ms_giftFont h1{
        font-size: 40px;
        padding-bottom: 50px;
    }
    .ms_giftImg{
        img{
            width: 100%;
        }
    }
}
@media only screen and (min-width:1200px){
        .ms_giftContainer{
            margin:100px auto;
        display: flex;
        justify-content: space-between;
        align-items: center;
        .ms_giftFont h1{
            font-size: 45px;
            padding-bottom: 0;
        }
    }       
}
</style>



