<template>
    <div>
        <div class="container-lista">
            <div v-for="apartment in apartments" :key="apartment.id" class="card">
                
                <div v-if="apartment.visible && apartment.sponsorships.length != 0" class="d-flex">
                    <router-link :to="{name: 'SingleApartment', params: {slug: apartment.slug}}" class="">
                        <div v-for="image in apartment.images" :key="image.id"><!-- non usare ccs su questo div -->
                            <p v-if="image.main_image"  class="card-immagine">
                                <img  :src="`/storage/${image.url}`"  class="border">
                            </p>
                        </div>
                    </router-link>
                    <div class=" descrizione">
                        <router-link :to="{name: 'SingleApartment', params: {slug: apartment.slug}}">
                            <h4>{{apartment.name}}</h4>
                        </router-link>
                        <p>stanze {{apartment.rooms}} letti {{apartment.beds}} bagni {{apartment.bathrooms}}</p>
                    </div>
                </div>

                <!-- non sposorizzate -->
                <div v-if="apartment.visible && apartment.sponsorships.length < 1" class="d-flex">
                    <router-link :to="{name: 'SingleApartment', params: {slug: apartment.slug}}" class="">
                        <div v-for="image in apartment.images" :key="image.id"><!-- non usare ccs su questo div -->
                            <p v-if="image.main_image"  class="card-immagine">
                                <img  :src="`/storage/${image.url}`"  class="border">
                            </p>
                        </div>
                    </router-link>
                    <div class=" descrizione">
                        <router-link :to="{name: 'SingleApartment', params: {slug: apartment.slug}}">
                            <h4>{{apartment.name}}</h4>
                        </router-link>
                        <ul>
                            <li>stanze {{apartment.rooms}}</li>
                            <li>letti {{apartment.beds}}</li>
                            <li>bagni {{apartment.bathrooms}}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "ApartmentList",
    data() {
        return{
            apartments: [],

        }
    },
    created() {
        axios
        .get("/api/apartments")
        .then((response) => {
            this.apartments = response.data;
        });
    },
};
</script>

<style lang="scss" scoped>
a{
    color:black;
    text-decoration:none;
}

img{
    height: 200px;
    width: 300px;
    border-radius: 13px
}

.descrizione{
    padding: 30px 20px;

}

.container-lista{
    margin-top: 400px
}

.card-immagine{
    margin-left:50px;
    margin-bottom:0;
    padding: 30px 0;
}

ul{
    li{
        float: left;
        color: grey;
        font-weight: bold;
        font-size: 13px;
    }
}
</style>