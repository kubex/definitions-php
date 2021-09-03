<?php
namespace Kubex\Definitions;

class LaunchMode
{
  public const Page = "page";     // (default) Render in the page
  public const Modal = "modal";    // Launch in a modal
  public const Lightbox = "lightbox"; // Launch in a modal
  public const Window = "window";   // Launch in a new window
  public const Overlay = "overlay";  // Right side overlay app
}
