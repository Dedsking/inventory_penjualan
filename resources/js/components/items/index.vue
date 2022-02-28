<template>
    <div class="container">
        <div class="row justify-content-center mt-3">
            <div class="col-md-12">
                <div class="card mt">
                    <div class="card-header">
                        <h3 class="card-title">Data Items</h3>
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
                                        <th>Nama Item</th>
                                        <th>Stok</th>
                                        <th>Unit</th>
                                        <th>Harga Satuan</th>
                                        <th>Barang</th>
                                        <th>Aksi</th>
                                    </tr>
                                    <tr v-for="item in items" :key="item.id">
                                        <td>{{ item.nama_item }}</td>
                                        <td>{{ item.stok }}</td>
                                        <td>{{ item.unit }}</td>
                                        <td>{{ item.harga_satuan }}</td>
                                        <td>{{ item.barang }}</td>
                                        <td>
                                            <a
                                                href="#"
                                                @click="showModalEdit(item)"
                                                ><i
                                                    class="fa-solid fa-pen-to-square"
                                                ></i
                                            ></a>
                                            |
                                            <a
                                                href="#"
                                                @click="deleteData(item.id)"
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
                            Tambah Item
                        </h5>
                        <h5
                            class="modal-title"
                            id="modalTambah1"
                            v-show="statusmodal"
                        >
                            Ubah Item
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
                                <label for="">Nama Item</label>
                                <input
                                    type="text"
                                    v-model="form.nama_item"
                                    class="form-control"
                                    :class="{
                                        'is-invalid':
                                            form.errors.has('nama_item'),
                                    }"
                                />
                                <has-error
                                    :form="form"
                                    field="nama_item"
                                ></has-error>
                            </div>
                            <div class="form-group">
                                <label for="">Stok</label>
                                <input
                                    type="number"
                                    v-model="form.stok"
                                    class="form-control"
                                    :class="{
                                        'is-invalid': form.errors.has('stok'),
                                    }"
                                />
                                <has-error
                                    :form="form"
                                    field="stok"
                                ></has-error>
                            </div>
                            <div class="form-group">
                                <label for="">Unit</label>
                                <select
                                    v-model="form.unit"
                                    class="form-control"
                                    :class="{
                                        'is-invalid': form.errors.has('unit'),
                                    }"
                                >
                                    <option value>Pilih Unit</option>
                                    <option value="pcs">pcs</option>
                                    <option value="kg">kg</option>
                                </select>
                                <has-error
                                    :form="form"
                                    field="unit"
                                ></has-error>
                            </div>
                            <div class="form-group">
                                <label for="">Harga Satuan</label>
                                <input
                                    type="number"
                                    v-model="form.harga_satuan"
                                    class="form-control"
                                    :class="{
                                        'is-invalid':
                                            form.errors.has('harga_satuan'),
                                    }"
                                />
                                <has-error
                                    :form="form"
                                    field="harga_satuan"
                                ></has-error>
                            </div>
                            <div class="mb-3">
                                <label for="formFile" class="form-label"
                                    >Barang</label
                                >
                                <input
                                    class="form-control form-control"
                                    id="formFile"
                                    type="file"
                                />
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
            items: {},
            statusmodal: false,
            form: new Form({
                id: "",
                nama_item: "",
                stok: "",
                unit: "",
                harga_satuan: "",
            }),
        };
    },
    methods: {
        showModal() {
            this.statusmodal = false;
            this.form.reset();
            $("#modalTambah").modal("show");
        },
        showModalEdit(item) {
            this.statusmodal = true;
            this.form.reset();
            $("#modalTambah").modal("show");
            this.form.fill(item);
        },
        loadData() {
            this.$Progress.start();
            axios.get("api/item").then(({ data }) => (this.items = data));
            this.$Progress.finish();
        },
        simpanData() {
            this.$Progress.start();
            this.loading = true;
            this.disabled = true;
            this.form
                .post("/api/item")
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
                .put("/api/item/" + this.form.id)
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
        deleteData(id) {
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
                        .delete("api/item/" + id)
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
        this.loadData();
        Fire.$on("refreshData", () => {
            this.loadData();
        });
    },
};
</script>
