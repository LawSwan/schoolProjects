from pyvis.network import Network

# Initialize the network
net = Network(directed=True)

# Add nodes with titles and groups for colors
net.add_node("INV_NUM", label="Invoice Number", title="INV_NUM", group=1)
net.add_node("PROD_NUM", label="Product Number", title="PROD_NUM", group=2)
net.add_node("SALE_DATE", label="Sale Date", title="SALE_DATE", group=1)
net.add_node("PROD_LABEL", label="Product Label", title="PROD_LABEL", group=2)
net.add_node("VEND_CODE", label="Vendor Code", title="VEND_CODE", group=3)
net.add_node("VEND_NAME", label="Vendor Name", title="VEND_NAME", group=3)
net.add_node("QUANT_SOLD", label="Quantity Sold", title="QUANT_SOLD", group=1)
net.add_node("PROD_PRICE", label="Product Price", title="PROD_PRICE", group=2)

# Add edges with labels
net.add_edge("INV_NUM", "SALE_DATE", label="Sale Date")
net.add_edge("INV_NUM", "VEND_CODE", label="Vendor Code")
net.add_edge("INV_NUM", "QUANT_SOLD", label="Quantity Sold")
net.add_edge("INV_NUM", "PROD_NUM", label="Product Number")
net.add_edge("PROD_NUM", "PROD_LABEL", label="Product Label")
net.add_edge("PROD_NUM", "PROD_PRICE", label="Product Price")
net.add_edge("VEND_CODE", "VEND_NAME", label="Vendor Name")

# Generate the network and save it to an HTML file
net.show("invoice_diagram.html")