<template>
    <div class="wrapper">
        <div class="row">
            <div class="col-lg-12 text-center">                
                <h1 class="search-title">
                    <img src="assets/images/logo/lnu_logo.png" alt="LNU Logo" style="height: 70px; width: 80px;">
                    Library Management System</h1>
            </div>
        </div>
        <div class="card-body">
            <form @submit.prevent="search">
                <div class="search-container">
                <input v-model="searchTerm" type="text" class="search-input" placeholder="Search Books...">
                <button class="search-button" type="submit">
                    <i><font-awesome-icon :icon="['fas', 'magnifying-glass']" /></i>
                </button>
                </div>
            </form>
            <div id="results">
                <div v-for="(result, index) in searchResults.data" :key="index" class="result-container">
                    {{ result }} 
                </div>
            </div>
            <nav id="pagination-nav">
                <ul class="pagination">
                    <li class="page-item" :class="{ 'disabled': !searchResults.first_page_url }">
                        <a class="page-link" @click="loadPage(searchResults.first_page_url)" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                    <li class="page-item" :class="{ 'disabled': !searchResults.prev_page_url }">
                        <a class="page-link" @click="loadPage(searchResults.prev_page_url)" aria-label="Previous">
                        <span aria-hidden="true">&lsaquo;</span>
                        </a>
                    </li>

                    <!-- Display page numbers in the middle with a maximum of 5 pages -->
                    <template v-if="searchResults.last_page > 1">
                        <li v-for="pageNumber in getPageRange()" :key="pageNumber" class="page-item" :class="{ 'active': pageNumber === searchResults.current_page }">
                        <a class="page-link" @click="loadPage(searchResults.path + '?page=' + pageNumber)">{{ pageNumber }}</a>
                        </li>
                    </template>
                    <li class="page-item" :class="{ 'disabled': !searchResults.next_page_url }">
                        <a class="page-link" @click="loadPage(searchResults.next_page_url)" aria-label="Next">
                        <span aria-hidden="true">&rsaquo;</span>
                        </a>
                    </li>
                    <li class="page-item" :class="{ 'disabled': !searchResults.last_page_url }">
                        <a class="page-link" @click="loadPage(searchResults.last_page_url)" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
    <loading-bar :isLoading="isLoading"></loading-bar>
</template>
<script>
    import LoadingBar from "../loadingbartop.vue";
    export default {
        mounted() {
            document.body.classList.add('lms-search-bg');

      },
      components: {
        LoadingBar,
      },
      data() {
        return {
          isLoading: false,
          searchTerm: '',
          searchResults: [],
          currentPage: 1,
        };
      },
      methods: {
        async search() {
          this.isLoading = true; // Start the loading state
          try {
            const response = await axios.get('/api/lms/search', {
                params: {
                    term: this.searchTerm,
                    page: this.currentPage, // Include the current page number in the request
                },
            });
            this.searchResults = response.data;
            setTimeout(() => {
              this.isLoading = false;
              this.$router.push('/');
            }, 300);
          } catch (error) {
            this.isLoading = false;
          }           
        },
        async loadPage(pageUrl) {
            if (!pageUrl) return;

            this.isLoading = true; // Start the loading state
            try {
                const response = await axios.get(pageUrl);
                this.searchResults = response.data;
                this.isLoading = false;
            } catch (error) {
                this.isLoading = false;
            }
        },
        getPageRange() {
            const currentPage = this.searchResults.current_page;
            const lastPage = this.searchResults.last_page;
            const maxPagesToShow = 10;

            let startPage = currentPage - Math.floor(maxPagesToShow / 2);
            if (startPage < 1) {
                startPage = 1;
            }

            let endPage = startPage + maxPagesToShow - 1;
            if (endPage > lastPage) {
                endPage = lastPage;
                startPage = Math.max(1, endPage - maxPagesToShow + 1);
            }

            return Array.from({ length: endPage - startPage + 1 }, (_, index) => startPage + index);
        },
      },
    };
</script>
<style scoped>
.wrapper{
    padding-top: 10px;
    padding-left: 70px;
    padding-right: 70px;
}
.form-control{
    height: 40px;
}
.search-title {
    text-align: center;
    font-size: 30px;
    color: #007bff;
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.4);
    font-weight: bold;
}
.result-container {
  display: flex;
  align-items: center;
  background: linear-gradient(135deg, #007bff, #00a8e8);
  border-radius: 5px;
  padding-top: 100px;
  padding: 5px;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
  width: 100%;
  margin-top: 10px;
  color: #fff;
}

.search-container {
  display: flex;
  align-items: center;
  background: linear-gradient(135deg, #007bff, #00a8e8);
  border-radius: 15px;  
  padding: 5px;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
  width: 100%;
  margin: 0 auto;
}

.search-input {
  border: none;
  outline: none;
  flex-grow: 1;
  padding: 5px;
  font-size: 16px;
  border-radius: 10px;
  transition: transform 0.2s;
  transform: scale(.98); 
  transform-origin: left center;
}
.search-input:focus {
  transform: scale(1.0); 
}
.search-button {
  background: #0056b3;
  border: none;
  border-radius: 15px;
  cursor: pointer;
  padding: 5px 10px;
  margin-left: 5px;
  transition: background-color 0.3s ease;
}
.search-button:hover {
  transform: scale(1.1); 
}
.search-button i {
  color: #fff;
  font-size: 20px;
}

.search-button:hover {
  background: #007bff; 
}
#pagination-nav{
    padding-top: 10px;
}
.page-item{
    cursor: pointer;
}
</style>