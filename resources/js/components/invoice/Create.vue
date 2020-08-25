<template>
    <div id="invoice">
        <div class="invoice overflow-auto">
            <div style="min-width: 600px;">
                <header>
                    <div class="row">
                        <div class="col">
                            <a target="_blank" href="#">
                                <img
                                    src="https://res.cloudinary.com/pixel-penguin/image/upload/c_scale,h_100/v1582807680/pixel_penguin_logos/new/pixel_penguin_without_creative_solutions-01_xaejgv.png"
                                    data-holder-rendered="true"
                                />
                            </a>
                        </div>
                        <div class="col company-details">
                            <h2 class="name">
                                <a target="_blank" href="#">
                                    PixelPenguin
                                </a>
                            </h2>
                            <div>PixelPenguin Place</div>
                            <div>(123) 456-789</div>
                            <div>sample@email.com</div>
                        </div>
                    </div>
                </header>

                <main>
                    <div class="row contacts">
                        <div class="col invoice-to">
                            <div class="text-gray-light">INVOICE TO:</div>
                            <h2 class="to">John Doe</h2>
                            <div class="address">The other street</div>
                            <div class="email">
                                <a href="mailto:john@example.com"
                                    >john@example.com</a
                                >
                            </div>
                        </div>
                        <div class="col invoice-details">
                            <h1 class="invoice-id">INVOICE #{{ invoiceId }}</h1>
                            <div class="date">
                                Date of Invoice:
                                {{ today }}
                            </div>
                            <div class="date">Due Date: {{ dueDate }}</div>
                        </div>
                    </div>

                    <div>
                        <div
                            class="btn btn-primary"
                            @click="insertNewProductModal = true"
                        >
                            Add new item to invoice
                        </div>
                    </div>

                    <table border="0" cellspacing="0" cellpadding="0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th class="text-left">DESCRIPTION</th>
                                <th class="text-right">PRICE</th>
                                <th class="text-right">QUANTITY</th>
                                <th class="text-right">TOTAL</th>
                                <th class="text-right">ACTION</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr
                                v-for="(invoiceItem, index) in invoiceItems"
                                :key="index"
                            >
                                <td class="no">{{ invoiceItem.product.id }}</td>
                                <td class="text-left">
                                    <h3>{{ invoiceItem.product.name }}</h3>
                                    {PRODUCT DESCRIPTION}
                                </td>
                                <td class="unit">
                                    ${{ invoiceItem.product.price }}
                                </td>
                                <td class="qty">{{ invoiceItem.quantity }}</td>
                                <td class="total">
                                    ${{
                                        invoiceItem.quantity *
                                            invoiceItem.product.price
                                    }}
                                </td>
                                <td>
                                    <div
                                        @click="removeProduct(index)"
                                        class="btn btn-danger"
                                    >
                                        Delete
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="2"></td>
                                <td colspan="2">SUBTOTAL</td>
                                <td>{{ subTotal }}</td>
                            </tr>
                            <tr>
                                <td colspan="2"></td>
                                <td colspan="2">TAX 25%</td>
                                <td>{{ taxPrice }}</td>
                            </tr>
                            <tr>
                                <td colspan="2"></td>
                                <td colspan="2">GRAND TOTAL</td>
                                <td>{{ totalPrice }}</td>
                            </tr>
                        </tfoot>
                    </table>
                    <div class="thanks">
                        Thank you!
                    </div>
                    <div class="notices">
                        <div>NOTICE:</div>
                        <div class="notice">
                            A finance charge of 1.5% will be made on unpaid
                            balances after due date.
                        </div>
                    </div>
                    <div
                        v-if="loading == false"
                        class="btn btn-success mt-2"
                        @click="saveInvoice"
                    >
                        Save Invoice
                    </div>
                    <div v-if="loading == true" class="btn btn-secondary">
                        Loading
                    </div>
                </main>
                <footer>
                    This is just a project and nothing more
                </footer>
            </div>
            <!--DO NOT DELETE THIS div. IT is responsible for showing footer always at the bottom-->
            <div></div>
        </div>

        <simple-modal v-model="insertNewProductModal" title="Add new item">
            <template slot="body">
                <form @submit="addNewRowToInvoice">
                    <div class="form-group">
                        <label for="item">Item</label>
                        <select
                            id="item"
                            name="item"
                            class="form-control"
                            v-model="newItem.invoice_item_product_id"
                            required
                        >
                            <option
                                v-for="invoiceItemProduct in invoiceItemProducts"
                                :key="invoiceItemProduct.id"
                                :value="invoiceItemProduct.id"
                                >{{ invoiceItemProduct.name }}</option
                            >
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="quantity">Quantity</label>
                        <input
                            id="quantity"
                            name="quantity"
                            class="form-control"
                            type="number"
                            v-model="newItem.quantity"
                            required
                        />
                    </div>
                    <button class="btn btn-primary" type="submit">
                        Add to Invoice
                    </button>
                </form>
            </template>
            <template slot="footer">
                <button>OK</button>
            </template>
        </simple-modal>
    </div>
</template>

<script>
import SimpleModal from "simple-modal-vue";
export default {
    components: {
        SimpleModal
    },
    mounted() {
        this.getInvoiceItemProducts();
    },
    data() {
        return {
            totalPrice: 0,
            subTotal: 0,
            taxPrice: 0,
            loading: false,
            insertNewProductModal: false,
            newItem: {
                quantity: 1,
                invoice_item_product_id: 0
            },
            invoiceItemProducts: [],
            invoiceItems: []
        };
    },
    methods: {
        getInvoiceItemProducts() {
            Vue.axios
                .get("/invoice/invoice-item-products/get")
                .then(response => {
                    var data = response.data;

                    if (data.success == true) {
                        this.invoiceItemProducts = data.data;
                    } else {
                        alert(data.message);
                    }
                })
                .catch(error => {});
        },
        createNewItemRow(invoice_item_product_id, quantity, price, product) {
            return {
                id: null,
                invoice_id: null,
                invoice_item_product_id: invoice_item_product_id,
                quantity: quantity,
                price: price,
                product: product
            };
        },
        addNewRowToInvoice(e) {
            e.preventDefault();
            let selectedProduct = this.invoiceItemProducts.find(
                prod => prod.id === this.newItem.invoice_item_product_id
            );
            let newRow = this.createNewItemRow(
                this.newItem.invoice_item_product_id,
                this.newItem.quantity,
                selectedProduct.price,
                selectedProduct
            );
            this.invoiceItems.push(newRow);
            this.CalculateTotalPrice();
        },
        CalculateTotalPrice() {
            let totalPrice = 0;

            this.invoiceItems.forEach((item, index) => {
                totalPrice += item.quantity * item.product.price;
            });
            this.totalPrice = totalPrice;
            this.taxPrice = this.totalPrice * 0.25;
            this.subTotal = this.totalPrice - this.taxPrice;
        },
        removeProduct(index) {
            this.invoiceItems.splice(index, 1);
        },
        saveInvoice() {
            this.loading = true;
            Vue.axios
                .post("/invoice/save", {
                    invoiceItems: this.invoiceItems,
                    totalPrice: this.totalPrice,
                    subTotal: this.subTotal,
                    taxPrice: this.taxPrice
                })
                .then(response => {
                    let data = response.data;
                    if (data.success == true) {
                        window.location = "/invoice";
                    }
                    this.loading = false;
                })
                .catch(error => {
                    this.loading = false;
                });
        }
    },
    computed: {
        today() {
            let today = new Date().toLocaleString("en-AU");
            return today.split(",")[0];
        },
        dueDate() {
            let today = new Date();
            let due = new Date(today.setDate(today.getDate() + 14))
                .toLocaleString("en-AU")
                .split(",")[0];
            return due;
        },
        invoiceId() {
            return Math.floor(Math.random() * 100000) + 1;
        }
    }
};
</script>

<style lang="scss" scoped></style>
