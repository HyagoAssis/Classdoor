<template>
    <Spinner v-if="requests"/>
    <template v-else-if="!items || items.length === 0">
        <p>Nenhum resultado encontrado</p>
    </template>
    <template v-else>
        <template v-for="item in items">
            <slot :item="item"/>
        </template>

        <nav class="mt-2 mb-4">
            <ul class="pagination justify-content-center">
                <li class="page-item">
                    <button class="page-link pagination-link"
                            @click="changePage(this.pagination.currentPage - 1)" aria-label="Previous"
                            :class="{disabled: this.pagination.currentPage === 1}"
                    >
                        <i class="bi bi-arrow-left-circle-fill"></i>
                    </button>
                </li>
                <template v-for="page in pages">
                    <li class="page-item">
                        <button class="page-link pagination-link fw-bold" @click="changePage(page)"
                                :class="{active: this.pagination.currentPage === page, 'pe-none': page === '...'}">
                            {{ page }}
                        </button>
                    </li>
                </template>
                <li class="page-item">
                    <button class="page-link pagination-link" @click="changePage(this.pagination.currentPage + 1)"
                            aria-label="Next" :class="{disabled: totalPages === this.pagination.currentPage}">
                        <i class="bi bi-arrow-right-circle-fill"></i>
                    </button>
                </li>
            </ul>
        </nav>
    </template>
</template>

<script>
import Spinner from "@/Components/Site/Spinner.vue";

const CancelToken = axios.CancelToken;
export default {
    name: 'DataList',
    components: {Spinner},

    props: {
        method: {
            type: Function,
            required: true,
        },
        params: Object,
        headers: Array
    },

    data() {
        return {
            requests: 0,
            items: null,
            pagination: {
                perPage: null,
                currentPage: 1,
                pageItemsCount: null,
                totalItemsCount: null,
            },
            cancelToken: undefined
        }
    },
    watch: {
        method: {
            immediate: true,
            handler(to) {
                if (to) {
                    this.fetchItems();
                }
            }
        },

        params: {
            immediate: true,
            deep: true,
            handler(to) {
                if (to) {
                    this.fetchItems();
                }
            },
        },

        'pagination.currentPage'() {
            this.fetchItems();
        },
    },

    methods: {
        fetchItems() {
            if (this.requestCancelToken) {
                this.requestCancelToken.cancel();
                this.requestCancelToken = undefined;
            }

            this.requests++;

            this.requestCancelToken = CancelToken.source();

            this.method({page: this.pagination.currentPage, ...this.params}, {
                cancelToken: this.requestCancelToken.token,
            }).then((response) => {
                this.items = response.data.data;
                this.updatePagination(response.data.meta);
            }).catch((error) => {
                if (!axios.isCancel(error)) {
                    this.$notification.error('Erro!', 'Não foi possível carregar os resultados')
                }
            }).then(() => this.requests--);
        },

        updatePagination(resourcePagination) {
            if (resourcePagination) {
                this.pagination.perPage = resourcePagination.per_page;
                this.pagination.currentPage = resourcePagination.current_page;
                this.pagination.totalItemsCount = resourcePagination.total;
            }
        },

        changePage(page) {
            this.pagination.currentPage = page;
        }
    },

    computed: {
        totalPages() {
            return Math.ceil(this.pagination.totalItemsCount / this.pagination.perPage);
        },

        pages() {
            let pages = [1];

            if(this.totalPages === 1){
                return pages;
            }

            let middle = [];

            for (
                let i = this.pagination.currentPage - 4 < 2 ? 2 : this.pagination.currentPage - 3;
                i <
                (this.pagination.currentPage + 4 > this.totalPages
                    ? this.totalPages
                    : this.pagination.currentPage + 4);
                i++
            ) {
                middle.push(i);
            }

            if (middle.length > 0) {
                if (middle[0] - 1 > 1) middle[0] = '...';

                if (middle[middle.length - 1] + 1 < this.totalPages)
                    middle[middle.length - 1] = '...';

                middle.forEach((val) => {
                    pages.push(val);
                });
            }

            pages.push(this.totalPages);

            return pages;
        },
    }
}

</script>
