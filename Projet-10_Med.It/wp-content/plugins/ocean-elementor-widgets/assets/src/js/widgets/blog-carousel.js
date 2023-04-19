import { registerWidget } from "../lib/utils";
import OEW_Carousel from "./base/carousel";

class OEW_BlogCarousel extends OEW_Carousel {}

registerWidget(OEW_BlogCarousel, "oew-blog-carousel");
