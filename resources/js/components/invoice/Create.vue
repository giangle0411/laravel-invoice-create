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
                <a href="mailto:john@example.com">john@example.com</a>
              </div>
            </div>
            <div class="col invoice-details">
              <h1 class="invoice-id">INVOICE {INSERT REFERENCE HERE}</h1>
              <div class="date">
                Date of Invoice: {INSERT DATE OF INVOICE HERE}
              </div>
              <div class="date">
                Due Date: {INSERT DATE OF INVOICE HERE + 14 DAYS}
              </div>
            </div>
          </div>

          <div>
            <div class="btn btn-primary">Add new item to invoice</div>
          </div>

          <table border="0" cellspacing="0" cellpadding="0">
            <thead>
              <tr>
                <th>#</th>
                <th class="text-left">DESCRIPTION</th>
                <th class="text-right">PRICE</th>
                <th class="text-right">QUANTITY</th>
                <th class="text-right">TOTAL</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td class="no">{PRODUCT ID HERE}</td>
                <td class="text-left">
                  <h3>{PRODUCT NAME}</h3>
                  {PRODUCT DESCRIPTION}
                </td>
                <td class="unit">{PRODUCT PRICE}</td>
                <td class="qty">{PRODUCT QUANTITY}</td>
                <td class="total">{PRODUCT PRICE * PRODUCT QUANTITY}</td>
              </tr>
              <tr>
                <td class="no">02</td>
                <td class="text-left">
                  <h3>Website Development</h3>
                  Developing a Content Management System-based Website
                </td>
                <td class="unit">$40.00</td>
                <td class="qty">80</td>
                <td class="total">$3,200.00</td>
              </tr>
              <tr>
                <td class="no">03</td>
                <td class="text-left">
                  <h3>Search Engines Optimization</h3>
                  Optimize the site for search engines (SEO)
                </td>
                <td class="unit">$40.00</td>
                <td class="qty">20</td>
                <td class="total">$800.00</td>
              </tr>
            </tbody>
            <tfoot>
              <tr>
                <td colspan="2"></td>
                <td colspan="2">SUBTOTAL</td>
                <td>{TOTAL SUBTRACTED BY 25%}</td>
              </tr>
              <tr>
                <td colspan="2"></td>
                <td colspan="2">TAX 25%</td>
                <td>{25% OF TOTAL}</td>
              </tr>
              <tr>
                <td colspan="2"></td>
                <td colspan="2">GRAND TOTAL</td>
                <td>{TOTAL}</td>
              </tr>
            </tfoot>
          </table>
          <div class="thanks">Thank you!</div>
          <div class="notices">
            <div>NOTICE:</div>
            <div class="notice">
              A finance charge of 1.5% will be made on unpaid balances after due
              date.
            </div>
          </div>
        </main>
        <footer>
          This is just a project and nothing more
        </footer>
      </div>
      <!--DO NOT DELETE THIS div. IT is responsible for showing footer always at the bottom-->
      <div></div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      loading: false,
    };
  },
  mounted() {},
  methods: {},
};
</script>

<style lang="scss" scoped>
</style>