<template>
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-12">
                <div class="card mt">
                    <div class="card-header">
                        <h3 class="card-title">Data Sales</h3>
                        <div class="card-tools">
                            <button
                                type="button"
                                class="btn btn-primary btn-sm"
                                data-bs-toggle="modal"
                                @click="showModal"
                            >
                                Tambah data
                            </button>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="form-group">
                            <div class="table-responsive">
                                <table class="table">
                                    <tr>
                                        <th>Code Transaksi</th>
                                        <th>Tanggal Transaksi</th>
                                        <th>Nama Costumer</th>
                                        <th>Nama Item</th>
                                        <th>Qty</th>
                                        <th>Total Diskon</th>
                                        <th>Total Bayar</th>
                                        <th>Aksi</th>
                                    </tr>
                                    <tr
                                        v-for="sale in sales"
                                        :key="sale.code_transaksi"
                                    >
                                        <td>{{ sale.code_transaksi }}</td>
                                        <td>{{ sale.tanggal_transaksi }}</td>
                                        <td></td>
                                        <td></td>
                                        <td>{{ sale.qty }}</td>
                                        <td>{{ sale.total_diskon }}</td>
                                        <td>{{ sale.total_bayar }}</td>
                                        <td>
                                            <a
                                                href="#"
                                                @click="showModalEdit(sale)"
                                                ><i
                                                    class="fa-solid fa-pen-to-square"
                                                ></i
                                            ></a>
                                            |
                                            <a
                                                href="#"
                                                @click="deleteData(sale.id)"
                                                ><i
                                                    class="fa-solid fa-trash"
                                                ></i
                                            ></a>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal -->
        <div
            class="modal fade"
            id="modalTambah"
            tabindex="-1"
            aria-labelledby="modalTambah1"
            aria-hidden="true"
        >
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5
                            class="modal-title"
                            id="modalTambah1"
                            v-show="!statusmodal"
                        >
                            Tambah Sales
                        </h5>
                        <h5
                            class="modal-title"
                            id="modalTambah1"
                            v-show="statusmodal"
                        >
                            Ubah Sales
                        </h5>
                        <button
                            type="button"
                            class="btn-close"
                            data-bs-dismiss="modal"
                            aria-label="Close"
                        ></button>
                    </div>
                    <form
                        @submit.prevent="
                            statusmodal ? ubahData() : simpanData()
                        "
                    >
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="">Tanggal Transaksi</label>
                                <input
                                    type="date"
                                    v-model="form.tanggal_transaksi"
                                    class="form-control"
                                    :class="{
                                        'is-invalid':
                                            form.errors.has(
                                                'tanggal_transaksi'
                                            ),
                                    }"
                                />
                                <has-error
                                    :form="form"
                                    field="tanggal_transaksi"
                                ></has-error>
                            </div>
                            <div class="form-group">
                                <label for="">Costumer</label>
                                <select
                                    v-model="form.costumer_id"
                                    class="form-control"
                                    :class="{
                                        'is-invalid':
                                            form.errors.has('costumer_id'),
                                    }"
                                >
                                    <option
                                        v-for="costumer in costumers"
                                        :key="costumer.id"
                                        :value="costumer.id"
                                    >
                                        {{ costumer.nama }}
                                    </option>
                                </select>
                                <has-error
                                    :form="form"
                                    field="costumer_id"
                                ></has-error>
                            </div>
                            <div class="form-group">
                                <label for="">Item</label>
                                <select
                                    v-model="form.item_id"
                                    class="form-control"
                                    :class="{
                                        'is-invalid':
                                            form.errors.has('item_id'),
                                    }"
                                >
                                    <option
                                        v-for="item in items"
                                        :key="item.id"
                                        :value="item.id"
                                    >
                                        {{ item.nama_item }}
                                    </option>
                                </select>
                                <has-error
                                    :form="form"
                                    field="item_id"
                                ></has-error>
                            </div>
                            <div class="form-group">
                                <label for="">Qty</label>
                                <input
                                    type="number"
                                    v-model="form.qty"
                                    class="form-control"
                                    :class="{
                                        'is-invalid': form.errors.has('qty'),
                                    }"
                                />
                                <has-error :form="form" field="qty"></has-error>
                            </div>
                            <div class="form-group">
                                <label for="">Total Diskon</label>
                                <input
                                    type="number"
                                    v-model="form.total_diskon"
                                    class="form-control"
                                    :class="{
                                        'is-invalid':
                                            form.errors.has('total_diskon'),
                                    }"
                                />
                                <has-error
                                    :form="form"
                                    field="total_diskon"
                                ></has-error>
                            </div>
                            <div class="form-group">
                                <label for="">Total Bayar</label>
                                <input
                                    type="number"
                                    v-model="form.total_bayar"
                                    class="form-control"
                                    :class="{
                                        'is-invalid':
                                            form.errors.has('total_bayar'),
                                    }"
                                />
                                <has-error
                                    :form="form"
                                    field="total_bayar"
                                ></has-error>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button
                                type="button"
                                class="btn btn-secondary"
                                data-bs-dismiss="modal"
                            >
                                Close
                            </button>
                            <button
                                type="submit"
                                class="btn btn-primary"
                                :disabled="disabled"
                                v-show="!statusmodal"
                            >
                                <i
                                    v-show="loading"
                                    class="fa fa-spinner fa-spin"
                                ></i>
                                Tambah
                            </button>
                            <button
                                type="submit"
                                class="btn btn-success"
                                :disabled="disabled"
                                v-show="statusmodal"
                            >
                                <i
                                    v-show="loading"
                                    class="fa fa-spinner fa-spin"
                                ></i>
                                Ubah
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import $ from "jquery/src/jquery.js";
export default {
    data() {
        return {
            loading: false,
            disabled: false,
            sales: {},
            items: {},
            costumers: {},
            statusmodal: false,
            form: new Form({
                code_transaksi: "",
                tanggal_transaksi: "",
                costumer_id: "",
                item_id: "",
                qty: "",
                total_diskon: "",
                total_bayar: "",
            }),
        };
    },
    methods: {
        showModal() {
            this.statusmodal = false;
            this.form.reset();
            $("#modalTambah").modal("show");
        },
        showModalEdit(sale) {
            this.statusmodal = true;
            this.form.reset();
            $("#modalTambah").modal("show");
            this.form.fill(sale);
        },
        loadData() {
            this.$Progress.start();
            axios.get("api/sale").then(({ data }) => (this.sales = data));
            this.$Progress.finish();
        },
        loadDataCostumer() {
            axios
                .get("api/costumer")
                .then(({ data }) => (this.costumers = data));
        },
        loadDataItem() {
            axios.get("api/item").then(({ data }) => (this.items = data));
        },
        simpanData() {
            this.$Progress.start();
            this.loading = true;
            this.disabled = true;
            this.form
                .post("/api/sale")
                .then(() => {
                    Fire.$emit("refreshData");
                    // this.resetForm();
                    $("#modalTambah").modal("hide");
                    Toast.fire({
                        icon: "success",
                        title: "Data Berasil tersimpan",
                    });
                    this.$Progress.finish();
                    this.loading = false;
                    this.disabled = false;
                })
                .catch(() => {
                    this.$Progress.fail();
                    this.loading = false;
                    this.disabled = false;
                });
        },
        ubahData() {
            this.loading = true;
            this.disabled = true;
            this.form
                .put("/api/sale/" + this.form.code_transaksi)
                .then(() => {
                    Fire.$emit("refreshData");
                    // this.resetForm();
                    $("#modalTambah").modal("hide");
                    Toast.fire({
                        icon: "success",
                        title: "Data Berasil terupdate",
                    });
                    this.loading = false;
                    this.disabled = false;
                })
                .catch(() => {
                    this.loading = false;
                    this.disabled = false;
                });
        },
        // resetForm() {
        //     this.form.reset();
        // },
        deleteData(code_transaksi) {
            Swal.fire({
                title: "Anda yakin ingin menghapus data ini ?",
                text: "Klik batal untuk membatalkan",
                icon: "Warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!",
            }).then((result) => {
                if (result.value) {
                    this.form
                        .delete("api/sale/" + code_transaksi)
                        .then(() => {
                            Swal.fire(
                                "Terhapus!",
                                "Data anda telah terhapus.",
                                "success"
                            );
                            Fire.$emit("refreshData");
                        })
                        .catch(() => {
                            Swal.fire(
                                "Gagal!",
                                "Data anda gagal terhapus.",
                                "warning"
                            );
                        });
                }
            });
        },
    },
    created() {
        this.loadDataCostumer();
        this.loadDataItem();
        this.loadData();
        Fire.$on("refreshData", () => {
            this.loadData();
        });
    },
};
</script>
